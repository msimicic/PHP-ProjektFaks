<?php
    $MySQL = mysqli_connect("localhost","root","","phpprojekt") or die('Error connecting to MySQL server.');

    if(!isset($_GET['delete'])) {
        print '
        <div class="container user-container">
            <h1 class="mt-3">Hello, '.$_SESSION['user']['firstName'].' '.$_SESSION['user']['lastName'].'!</h1>
            <h3 class="mt-3">All users</h3>';
            
            // Paginacija
            $items_per_page = 5;
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            // Pomak odakle kreće dohvaćati podatke iz baze ovisno o stranici
            $offset = ($current_page - 1) * $items_per_page;

            $query = "SELECT * FROM users LIMIT $offset, $items_per_page";
            $result = @mysqli_query($MySQL, $query);    
        print'<div class="container table-container">
                <table class="table">
                    <thead>';
                    if($_SESSION['user']['isAdmin'] == 1) {
                        print'<th>Edit</th>
                        <th>Delete</th>';
                    }
                    print'<th>Ime</th>
                        <th>Prezime</th>
                    </thead>
                    <tbody>';
            while($row = @mysqli_fetch_array($result)) {
                print'<tr>';
                if($_SESSION['user']['isAdmin'] == 1) {
                    if($row['is_admin'] != 1) {
                        print"
                            <td>
                                <a href=index.php?edit=". $row['id'] ."><i class='bi bi-pencil'></i></a>
                            </td>
                            <td>
                                <a href=index.php?menu=7&delete=". $row['id'] ."><i class='bi bi-trash'></i></a>
                            </td>";
                    } else {
                        print "<td></td><td></td>";
                    }
                }
                print"<td>
                        " . $row['first_name'] . "
                    </td>
                    <td>
                        <span style='color:green'>" . $row['last_name'] . "</span>
                    </td>
                </tr>";
            }
            print '</tbody>
                </table>
            </div>';

            echo '<nav class="pagination justify-content-center" aria-label="Page navigation example">
                <ul class="pagination">';

                $all_data_query = "SELECT * FROM users";
                $all_data_result = mysqli_query($MySQL, $all_data_query);
                $number_of_result = mysqli_num_rows($all_data_result); 
                $total_pages = ceil ($number_of_result / $items_per_page);  

                $visible_pages = 3;
                $first_visible_page = max(1, $current_page - 1);

                // Tipka "Prethodna"
                if ($current_page > 1) {
                    echo '<li class="page-item"><a class="page-link" href="index.php?menu=7&page='.($current_page-1).'">&laquo;</a></li>';
                } else {
                    echo '<li class="page-item disabled"><span class="page-link">&laquo;</span></li>';
                }

                // Brojevi stranica
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i >= $first_visible_page && $i < $first_visible_page + $visible_pages) {
                        if ($i == $current_page) {
                            echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                        } else {
                            echo '<li class="page-item"><a class="page-link" href="index.php?menu=7&page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                }

                // Tipka "Sljedeća"
                if ($current_page < $total_pages) {
                    echo '<li class="page-item"><a class="page-link" href="index.php?menu=7&page='.($current_page+1).'" aria-label="Next">&raquo;</a></li>';
                } else {
                    echo '<li class="page-item disabled"><span class="page-link" aria-disabled="true">&raquo;</span></li>';
                }

            echo '</ul>
            </nav>';
    print'</div>';
    } else {
        $queryDelete  = "DELETE FROM users WHERE id=" . (int)$_GET['delete']; 
        $resultDelete = @mysqli_query($MySQL, $queryDelete);

        header("Location: index.php?menu=7");
        exit();
    
        print '<p class="alert alert-danger">Podaci su uspješno obrisani!</p>';
    }
?>