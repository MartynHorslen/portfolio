                
            </main>
        <!-- </div> -->
        <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
        <script src="js/type-effect.js"></script>
        <script src="js/menu.js"></script>
        <script src="js/contact.js"></script>
        <?php
        if ($_SERVER['REQUEST_URI'] == "/scion.php"){
            echo '<script src="js/treehouse.js"></script>';
        }
        ?>
        
    </body>
</html>