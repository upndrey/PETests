<script src="../scripts/index.js"></script>

<?
if($_SESSION['message'] != ""){
    echo "
        <script>
        alert('" . $_SESSION['message'] . "');
        </script>
        ";
    $_SESSION['message'] = "";
}
?>
</body>
</html>