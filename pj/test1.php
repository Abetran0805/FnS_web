<html>

<head>
    <title>Demo Search Basic by freetuts.net</title>
</head>

<body>
    <div align="center">
        <form action="search.php" method="get">
            Search: <input type="text" name="search" />
            <input type="submit" name="ok" value="search" />
        </form>
    </div>
    <?php
    // Nếu người dùng submit form thì thực hiện
    if (isset($_REQUEST['ok'])) {
        // Gán hàm addslashes để chống sql injection
        $search = addslashes($_GET['search']);

        // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
        if (empty($search)) {
            echo "Yeu cau nhap du lieu vao o trong";
        } else {

            // Kết nối sql
            $ten = null;
            if (isset($_GET["tendetai"])) {
                $ten = $_GET["tendetai"];
            }
            require_once('./database.php');
            include('./ketnoi.php');
            $sql = 'SELECT * FROM detai WHERE tendaitai like ' % $search % '"';
            $result = db_get_list($sql);


            // Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
            if ($result > 0 && $search != "") {
                // Dùng $result để đếm số dòng trả về.
                echo "$result ket qua tra ve voi tu khoa <b>$search</b>";

                // Hàm foreach dùng để lấy toàn bộ dữ liệu có trong table và trả về dữ liệu ở dạng array.

                foreach ($result as $card) {
                    //print_r($url);
                    echo '<div class="card ">
                        <table class="table table-hover">
                        <tr>
                            <td>
                                <h5 class="name">' . $card['tendetai'] . '</h5>
                                <h5 class="urldetai">' . $card['urldetai'] . '</h5>
                            </td>    
                        </tr>          
                        </table>
                        </div>';
                }
                echo '</table>';
            } else {
                echo "Khong tim thay ket qua!";
            }
        }
    } ?>
</body>

</html>