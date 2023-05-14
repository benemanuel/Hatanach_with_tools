<?PHP
function db_call($table='',$query=''){
    global $debug_flag;
    if ($debug_flag) {echo "<p debug='fun db_call:[". $table ."]".$query."'></p>";}
    $servername = "localhost";
    $dbname = "verses";
    $charset = 'utf8';

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $dsn = "mysql:host=$servername;dbname=$dbname;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $username, $password, $opt);
    $result = $pdo->query($query)->fetchAll();
    mysqli_close($conn);
    return $result;
}
