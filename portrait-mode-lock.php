<?php

/**

 * Plugin Name: Portrait Mode Lock

 * Description: Shows a message prompting mobile users to rotate their phone when in landscape mode

 * Version: 1.0

 * Author: Your Name

 */



// Prevent direct access

if (!defined('ABSPATH')) {

    exit;

}



// Add the orientation lock HTML and script to the footer

function pml_add_orientation_lock() {

    ?>

    <div id="orientation-lock">

        <div class="lock-box">

            <h2>Please rotate your device to continue.</h2>

            <p>This page is optimised for portrait view.</p>

        </div>

    </div>

    

    <style>

        #orientation-lock {

            display: none;

            position: fixed;

            top: 0;

            left: 0;

            width: 100%;

            height: 100%;

            background: rgba(0, 0, 0, 0.95);

            z-index: 999999;

            justify-content: center;

            align-items: center;

        }

        #orientation-lock .lock-box {

            text-align: center;

            color: white;

            padding: 40px;

            max-width: 90%;

        }

        #orientation-lock h2 {

            font-size: 24px;

            margin-bottom: 15px;
            color:white !important;

        }

        #orientation-lock p {

            font-size: 16px;

        }

    </style>



    <script>

    (function () {

        function isMobileDevice() {

            return window.matchMedia("(max-width: 1200px)").matches &&

                   ('ontouchstart' in window || navigator.maxTouchPoints > 0);

        }

        

        function lockOrientation() {

            if (!isMobileDevice()) return;

            const overlay = document.getElementById('orientation-lock');

            if (!overlay) return;

            const isLandscape = window.matchMedia("(orientation: landscape)").matches;

            

            if (isLandscape) {

                overlay.style.display = 'flex';

                document.body.style.position = 'fixed';

                document.body.style.width = '100%';

            } else {

                overlay.style.display = 'none';

                document.body.style.position = '';

            }

        }

        

        window.addEventListener('load', lockOrientation);

        window.addEventListener('resize', lockOrientation);

        window.addEventListener('orientationchange', function () {

            setTimeout(lockOrientation, 300);

        });

    })();

    </script>

    <?php

}

add_action('wp_footer', 'pml_add_orientation_lock');

?>