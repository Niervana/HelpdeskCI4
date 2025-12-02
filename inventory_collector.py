#!/usr/bin/env python3
"""
IT Helpdesk Inventory Collector
Automatically collects PC specifications and sends them to the IT Helpdesk API.

Compatible with Windows 7/8/10/11.
"""

import platform
import socket
import psutil
import requests
import json
import sys
import time
from datetime import datetime

# ============================================
# CONFIGURATION - EDIT BAGIAN INI
# ============================================

# API endpoint URL - sesuaikan dengan server CI4 Anda
API_URL = "http://192.168.0.250:8000/api/update-main-device"

# API Key untuk autentikasi - HARUS SAMA dengan yang ada di .env file CI4
API_KEY = "VyyLY87xmeQ712gGkWR72YNDhFHFbfR6"

# ============================================
# JANGAN EDIT DIBAWAH INI
# ============================================


def get_cpu_info():
    """Get CPU information with better formatting."""
    try:
        # Try to get CPU brand name using cpuinfo library
        import cpuinfo
        cpu_info = cpuinfo.get_cpu_info()
        brand = cpu_info.get('brand_raw', '')

        # Clean up common CPU names for better readability
        brand = brand.replace('(R)', '').replace('(TM)', '').replace('CPU', '').strip()
        brand = brand.replace('  ', ' ')  # Remove double spaces

        # Extract key information for AMD Ryzen
        if 'AMD' in brand.upper():
            # Try to extract Ryzen model
            import re
            ryzen_match = re.search(r'Ryzen\s*\d+\s*\d*[A-Za-z]*', brand, re.IGNORECASE)
            if ryzen_match:
                return ryzen_match.group().strip()

        # Extract key information for Intel Core
        if 'Intel' in brand.upper() or 'Core' in brand:
            import re
            core_match = re.search(r'(?:Intel\s*)?(?:Core\s+)?i\d+[-\s]*\d*[A-Za-z]*', brand, re.IGNORECASE)
            if core_match:
                return core_match.group().strip()

        return brand if brand else "Unknown CPU"

    except ImportError:
        # Fallback if cpuinfo is not available
        try:
            # Try using wmic for Windows
            import subprocess
            result = subprocess.check_output(
                'wmic cpu get name /value', shell=True
            ).decode(errors='ignore').strip()

            # Parse the result
            for line in result.split('\n'):
                if line.startswith('Name='):
                    cpu_name = line.split('=', 1)[1].strip()
                    # Clean up the name
                    cpu_name = cpu_name.replace('(R)', '').replace('(TM)', '').replace('CPU', '').strip()
                    return cpu_name

        except:
            pass

        # Final fallback
        try:
            cpu = platform.processor()
            if cpu and cpu.strip():
                return cpu
        except:
            pass

        return "Unknown CPU"


def get_ram_info():
    """Get physical RAM information in GB."""
    try:
        import wmi
        wmi_obj = wmi.WMI()

        # Get physical memory modules
        total_ram = 0
        for memory in wmi_obj.Win32_PhysicalMemory():
            capacity = int(memory.Capacity)
            total_ram += capacity

        # Convert bytes to GB
        ram_gb = total_ram / (1024 ** 3)

        # Return exact RAM size
        return f"{ram_gb:.0f} GB"
    except:
        # Fallback to psutil
        try:
            ram_gb = psutil.virtual_memory().total / (1024 ** 3)
            return f"{ram_gb:.0f}"
        except:
            return "Unknown"


def get_os_info():
    """Get OS information using WMI."""
    try:
        import wmi
        wmi_obj = wmi.WMI()
        os_info = wmi_obj.Win32_OperatingSystem()[0]
        os_name = os_info.Caption.replace("Microsoft ", "").strip()
        build = os_info.BuildNumber
        release_map = {
            "19041": "20H2",
            "19042": "20H2",
            "19043": "21H2",
            "19044": "21H2",
            "19045": "22H2",
            "22000": "21H2",
            "22621": "22H2",
        }
        release = release_map.get(build, build)
        return f"{os_name} {release}"
    except:
        return "Unknown OS"


def get_ip_address():
    """Get IP address."""
    try:
        hostname = socket.gethostname()
        ip_address = socket.gethostbyname(hostname)
        return ip_address
    except:
        return "Unknown"


def get_hostname():
    """Get hostname."""
    try:
        return platform.node()
    except:
        return "Unknown"


def get_storage_info():
    """Get physical storage information with accurate type detection using multiple methods."""
    try:
        import wmi
        wmi_obj = wmi.WMI()

        storages = []
        for disk in wmi_obj.Win32_DiskDrive():
            storage_name = disk.Model
            storage_size_bytes = int(disk.Size)
            
            # Use decimal (base-10) calculation to match physical/marketing capacity
            storage_size_gb_decimal = storage_size_bytes / (1000**3)

            # Get all relevant properties
            interface_type = getattr(disk, 'InterfaceType', '').upper()
            media_type = getattr(disk, 'MediaType', '').upper()
            pnp_device_id = getattr(disk, 'PNPDeviceID', '').upper()
            caption = getattr(disk, 'Caption', '').upper()
            description = getattr(disk, 'Description', '').upper()
            
            # Initialize storage type
            storage_type = "HDD"
            storage_name_upper = storage_name.upper()
            
            # === METHOD 1: Direct NVMe Detection ===
            nvme_detected = False
            
            # Check in multiple fields
            nvme_keywords = ["NVME", "NVM EXPRESS", "NVME SSD"]
            search_fields = [
                interface_type,
                pnp_device_id,
                storage_name_upper,
                caption,
                description
            ]
            
            for field in search_fields:
                if any(keyword in field for keyword in nvme_keywords):
                    nvme_detected = True
                    break
            
            # Additional check: PCIe in model name usually indicates NVMe
            if "PCIE" in storage_name_upper and any(term in storage_name_upper for term in ["SSD", "SOLID"]):
                nvme_detected = True
            
            if nvme_detected:
                storage_type = "NVMe"
            
            # === METHOD 2: SSD Detection (if not NVMe) ===
            elif not nvme_detected:
                ssd_detected = False
                
                # Direct SSD keywords in name/description
                ssd_keywords = ["SSD", "SOLID STATE", "SATA SSD"]
                for field in [storage_name_upper, media_type, caption, description]:
                    if any(keyword in field for keyword in ssd_keywords):
                        ssd_detected = True
                        break
                
                # Known SSD brand patterns
                ssd_brand_patterns = [
                    "SAMSUNG SSD", "KINGSTON SSD", "WD SSD", "CRUCIAL SSD",
                    "INTEL SSD", "SANDISK SSD", "CORSAIR SSD", "ADATA SSD",
                    "GIGABYTE SSD", "SEAGATE SSD", "TOSHIBA SSD"
                ]
                
                for pattern in ssd_brand_patterns:
                    if pattern in storage_name_upper:
                        ssd_detected = True
                        break
                
                if ssd_detected:
                    storage_type = "SSD SATA"
                else:
                    # === METHOD 3: Heuristic Detection ===
                    # Some SSDs don't explicitly say "SSD" in their name
                    # We can use heuristics based on known SSD characteristics
                    
                    # Known SSD model number patterns
                    import re
                    
                    # Samsung: 850/860/870/980 EVO, PRO, QVO
                    if re.search(r'(8[5-7]0|9[0-8]0)\s*(EVO|PRO|QVO)', storage_name_upper):
                        storage_type = "SSD SATA"
                        ssd_detected = True
                    
                    # Crucial: MX/BX/P series
                    if re.search(r'(MX|BX|P)\d{3}', storage_name_upper):
                        storage_type = "SSD SATA"
                        ssd_detected = True
                    
                    # WD: Blue/Green/Black with SN/SA number
                    if re.search(r'(SN|SA)\d{3,4}', storage_name_upper) and any(color in storage_name_upper for color in ['BLUE', 'GREEN', 'BLACK']):
                        storage_type = "SSD SATA"
                        ssd_detected = True
                    
                    # Kingston: SA/SUV/SKC models
                    if re.search(r'(SA|SUV|SKC)\d{3}', storage_name_upper):
                        storage_type = "SSD SATA"
                        ssd_detected = True
                    
                    # Micron-based SSDs (but not marked as NVMe)
                    # Only if not already detected as NVMe
                    if 'MICRON' in storage_name_upper and not nvme_detected:
                        # Micron makes both SATA SSDs and NVMe
                        # If we reach here and it's Micron, it's likely SATA SSD
                        if any(indicator in storage_name_upper for indicator in ['MTFD', '1100', '5100', '5200', '5300']):
                            storage_type = "SSD SATA"
                            ssd_detected = True

            # === METHOD 4: Interface-based Override ===
            # Final sanity check based on interface type
            if storage_type in ["SSD SATA", "NVMe"]:
                # If interface is IDE, it's definitely not SSD/NVMe (too old)
                if interface_type == "IDE":
                    # Unless name explicitly says SSD (rare case)
                    if "SSD" not in storage_name_upper and "NVME" not in pnp_device_id:
                        storage_type = "HDD"
                
                # USB drives could be SSD but usually external
                # Keep detection if explicitly labeled as SSD
                elif interface_type == "USB":
                    if not any(term in storage_name_upper for term in ["SSD", "SOLID STATE"]):
                        if "NVME" not in pnp_device_id:
                            # Could be external HDD, but keep SSD if detected
                            pass  # Keep current detection

            # === Capacity Rounding ===
            # Round to common physical storage sizes
            capacity_map = {
                (120, 125): "120",
                (125, 135): "128",
                (240, 250): "240",
                (250, 270): "256",
                (480, 500): "500",
                (500, 520): "512",
                (950, 1000): "1000",
                (1000, 1050): "1024",
                (1900, 2000): "2000",
                (2000, 2100): "2048",
                (3900, 4000): "4000",
                (4000, 4200): "4096",
            }
            
            storage_capacity = None
            for (min_size, max_size), capacity in capacity_map.items():
                if min_size <= storage_size_gb_decimal < max_size:
                    storage_capacity = capacity
                    break
            
            if storage_capacity is None:
                # Non-standard size, round to nearest whole number
                storage_capacity = f"{storage_size_gb_decimal:.0f}"

            storages.append(f"{storage_type} {storage_capacity} GB")

        return ", ".join(storages) if storages else "Unknown"
        
    except Exception as e:
        return f"Unknown (Error: {str(e)})"


# Optional: Tambahkan fungsi helper untuk testing
def test_storage_detection():
    """Test function to verify storage detection on current system."""
    print("\n" + "="*70)
    print("STORAGE DETECTION TEST")
    print("="*70)
    
    try:
        import wmi
        wmi_obj = wmi.WMI()
        
        for idx, disk in enumerate(wmi_obj.Win32_DiskDrive(), 1):
            print(f"\nDisk #{idx}:")
            print(f"  Model: {disk.Model}")
            print(f"  Interface: {getattr(disk, 'InterfaceType', 'N/A')}")
            print(f"  PNPDeviceID: {getattr(disk, 'PNPDeviceID', 'N/A')[:60]}...")
            print(f"  Size: {int(disk.Size) / (1000**3):.2f} GB")
            print(f"  → Detected as: {get_storage_info()}")
    except Exception as e:
        print(f"Error: {e}")
    
    print("="*70 + "\n")


# Uncomment to run test
# if __name__ == "__main__":
#     test_storage_detection()


def get_device_model():
    """Get device model with full product name lookup."""
    try:
        import wmi
        c = wmi.WMI()

        # List of generic names to avoid
        generic_names = [
            "System Product Name", 
            "Computer System Product", 
            "To Be Filled By O.E.M.", 
            "Default String",
            "INVALID"
        ]

        # First, try to get system model/version (often contains full product name)
        try:
            cs = c.Win32_ComputerSystem()[0]
            model = cs.Model or ""
            
            # Check if model contains useful information
            if model and model.strip() and model not in generic_names:
                # For Lenovo, check if it's a short code like "82K2"
                if len(model) <= 6 and model.isalnum():
                    # Try to get the full name from SystemFamily or other properties
                    try:
                        bios = c.Win32_BIOS()[0]
                        # Some manufacturers put full name in version
                        version = getattr(cs, 'SystemFamily', None)
                        if version and version.strip() and version not in generic_names:
                            return version.strip()
                    except:
                        pass
                    
                    # If still short code, try Win32_ComputerSystemProduct
                    try:
                        product = c.Win32_ComputerSystemProduct()[0]
                        version = product.Version or ""
                        if version and version.strip() and version not in generic_names:
                            manufacturer = cs.Manufacturer or ""
                            return f"{manufacturer} {version}".strip()
                    except:
                        pass
                    
                    # Return with manufacturer prefix
                    manufacturer = cs.Manufacturer or ""
                    return f"{manufacturer} {model}".strip()
                else:
                    # Model already contains full name
                    return model.strip()
        except:
            pass

        # Try Win32_ComputerSystemProduct
        try:
            product = c.Win32_ComputerSystemProduct()[0]
            
            # Try Version first (often contains full product name)
            version = product.Version or ""
            if version and version.strip() and version not in generic_names:
                cs = c.Win32_ComputerSystem()[0]
                manufacturer = cs.Manufacturer or ""
                return f"{manufacturer} {version}".strip()
            
            # Try Name
            name = product.Name or ""
            if name and name.strip() and name not in generic_names:
                cs = c.Win32_ComputerSystem()[0]
                manufacturer = cs.Manufacturer or ""
                return f"{manufacturer} {name}".strip()
        except:
            pass

        # Fallback to Manufacturer + Model
        try:
            cs = c.Win32_ComputerSystem()[0]
            manufacturer = cs.Manufacturer or ""
            model = cs.Model or ""
            full_name = f"{manufacturer} {model}".strip()
            
            if full_name and not any(generic in full_name for generic in generic_names):
                return full_name
        except:
            pass

        return "Unknown Device"
        
    except Exception as e:
        return f"Unknown Device (Error: {str(e)})"


def collect_system_info():
    """Collect all system information."""
    return {
        # jenis, lisensi_windows, credential, office, lisensi_office
        # will be filled manually by admin (role 1) through the web interface
        'manufaktur': get_device_model(),
        'cpu': get_cpu_info(),
        'ram': get_ram_info(),
        'os': get_os_info(),
        'ipaddress': get_ip_address(),
        'hostname': get_hostname(),
        'storage': get_storage_info()
    }


def send_to_api(email, data):
    """Send collected data to API."""
    # Structure payload as expected by API
    payload = {
        'email': email,
        'data': data,
        'timestamp': datetime.now().isoformat()
    }

    # Headers with API Key
    headers = {
        'Content-Type': 'application/json',
        'X-API-Key': API_KEY,
        'User-Agent': 'IT-Helpdesk-Inventory-Collector/1.0'
    }

    try:
        response = requests.post(API_URL, json=payload, headers=headers, timeout=30)
        return response, None
    except requests.exceptions.ConnectionError:
        return None, "Connection error: Cannot connect to server. Please check if the server is running."
    except requests.exceptions.Timeout:
        return None, "Timeout error: Server took too long to respond."
    except requests.exceptions.RequestException as e:
        return None, f"Request error: {str(e)}"


def main():
    print("=" * 60)
    print("=== Nirvana IT Helpdesk Inventory Collector ===".center(60))
    print("=" * 60)
    print()
    print("This script will collect your PC specifications and send them")
    print("to the IT Helpdesk system.")
    print()
    
    # Check if API_KEY is configured
    if not API_KEY or API_KEY == "your-api-key-here":
        print("⚠ ERROR: API Key is not configured!")
        print("Please contact your IT administrator to get the API Key.")
        print("Then edit this script and update the API_KEY variable.")
        input("\nPress Enter to exit...")
        sys.exit(1)

    # Get user email
    print("Please enter your registered email address.")
    while True:
        email = input("Email: ").strip()
        if '@' in email and '.' in email:
            break
        print("⚠ Please enter a valid email address.")
        print()

    print()
    print("Collecting system information...")
    print()
    
    try:
        data = collect_system_info()
    except Exception as e:
        print(f"✗ Error collecting system information: {e}")
        input("\nPress Enter to exit...")
        sys.exit(1)

    # Display collected data
    print("Collected data:")
    print("-" * 60)
    for key, value in data.items():
        if value is not None:
            print(f"  {key:20s}: {value}")
    print("-" * 60)
    print()

    # Confirm before sending
    confirm = input("Send this data to the server? (y/N): ").strip().lower()
    if confirm != 'y':
        print("Operation cancelled.")
        input("\nPress Enter to exit...")
        sys.exit(0)

    print()
    print("Sending data to server...")
    
    response, error = send_to_api(email, data)

    if error:
        print(f"✗ Error: {error}")
        print()
        print("Troubleshooting:")
        print("  1. Check if CI4 server is running")
        print("  2. Verify the API URL is correct")
        print("  3. Check your network connection")
        input("\nPress Enter to exit...")
        sys.exit(1)

    # Handle response
    print()
    if response.status_code == 200 or response.status_code == 201:
        try:
            result = response.json()
            if result.get('status') == 'success':
                print("✓ SUCCESS: Data sent successfully!")
                print(f"✓ {result.get('message', 'Inventory updated.')}")
                print()
                print("Your PC information has been recorded in the system.")
            else:
                print("✗ Server returned an error:")
                print(f"  {result.get('message', 'Unknown error')}")
        except:
            print("✓ SUCCESS: Data sent successfully!")
            print("(Server response format was unexpected, but data was received)")
            
    elif response.status_code == 401:
        print("✗ AUTHENTICATION ERROR (401)")
        print("  Invalid API Key!")
        print()
        print("Please check:")
        print("  1. API_KEY in this script matches the one in CI4 .env file")
        print("  2. Contact IT administrator if you need a new API Key")
        
    elif response.status_code == 404:
        print("✗ ERROR (404): Email not found in database")
        print()
        print("Please make sure:")
        print("  1. You have registered an account in the IT Helpdesk system")
        print("  2. The email you entered is correct")
        
    elif response.status_code == 422:
        print("✗ VALIDATION ERROR (422)")
        try:
            result = response.json()
            print(f"  {result.get('message', 'Invalid data format')}")
            if 'errors' in result:
                for field, error in result['errors'].items():
                    print(f"  - {field}: {error}")
        except:
            print(f"  {response.text}")
            
    else:
        print(f"✗ SERVER ERROR (HTTP {response.status_code})")
        try:
            result = response.json()
            print(f"  {result.get('message', 'Unknown error')}")
        except:
            print(f"  Response: {response.text[:200]}")

    print()
    input("Press Enter to exit...")


if __name__ == "__main__":
    try:
        main()
    except KeyboardInterrupt:
        print("\n\nOperation cancelled by user.")
        sys.exit(0)
    except Exception as e:
        print(f"\n✗ An unexpected error occurred: {e}")
        print("\nPlease contact IT support if this problem persists.")
        input("\nPress Enter to exit...")
        sys.exit(1)