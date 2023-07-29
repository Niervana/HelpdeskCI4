<?php
function iziToast($type, $title, $message)
{
    $script = '<script>
                iziToast.' . $type . '({
                    title: "' . $title . '",
                    message: "' . $message . '"
                });
               </script>';
    echo $script;
    return service('redirect');
}
