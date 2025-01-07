<?php
function authorisedUser(){
    if(isset($_SESSION['ID'])){
        return true;
    }
    return false;
}

/*
function handleUser($content){
    if(authorisedUser() === false)
    {
    echo '<div class="d-grid justify-content-center">
            <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href=\'logowanie\'">Log In</button> </br>
            <button type="button" class="btn btn-outline-secondary btn-lg" onclick="window.location.href=\'rejestracja\'">Register</button>
          </div>';
    }
    else
    {
        $content; // SHOW CONTENT OF THE PAGE IF THE USER IS LOGGED IN
    }
}
*/

function loginTaken($conn, $login){
    $sql = "SELECT * FROM `User` WHERE login = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../rejestracja?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $login);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Если нашли пользователя
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return false;
    }
}

function passwordsDontMatch($password, $repeatPassword)
{
    if ($password !== $repeatPassword) {
        return true;
    }
    return false;
}




function raiseMessageAndRedirect($redirectURL)
{
    if(isset($_GET['error']))
    {
        if($_GET['error'] === 'logintaken')
        {
            echo '<div class="alert alert-danger" role="alert">
                    Użyktownik z takim imieniem już istnieje!
                  </div>';
        }
        if($_GET['error'] === 'passwordsdontmatch')
        {
            echo '<div class="alert alert-danger" role="alert">
                    Hasła nie są identyczne!
                  </div>';
        }
        if($_GET['error'] === 'incorrectpassword')
        {
            echo '<div class="alert alert-danger" role="alert">
                    Nieprawidłowe hasło!
                  </div>';
        }
        if($_GET['error'] === 'usernotfound')
        {
            echo '<div class="alert alert-danger" role="alert">
                    Nie znaleziono użyktownika o takim imieniu!
                  </div>';
        }
        if($_GET['error'] === 'loginnone')
        {
            echo '<div class="alert alert-success" role="alert">
                    Logowanie odbyło się poprawnie!
                  </div>';
            header("Refresh: 1; URL=$redirectURL");
        }
        if($_GET['error'] === 'registrationnone')
        {
            echo '<div class="alert alert-success" role="alert">
                    Rejestracja odbyła się poprawnie!
                  </div>';
            header("Refresh: 1; URL=$redirectURL");
        }
    }
}

function loginUser($conn, $login, $password)
{
    $sql = "SELECT * FROM `User` WHERE Login = ?";
    $query = $conn->prepare($sql);
    $query->bind_param('s', $login);
    $query->execute();

    $result = $query->get_result();
    if ($row = $result->fetch_assoc()) 
    {  
    if (password_verify($password, $row['Password'])) {
        $_SESSION['ID'] = $row['ID'];
        header("Location: ../logowanie?error=loginnone");
        exit();
    } 
    else 
    {
        header("Location: ../logowanie?error=incorrectpassword");
        exit();
    }
    }
    else 
    {
        header("Location: ../logowanie?error=usernotfound");
        exit();
    }
}


function getAllAttributes($conn)
{
    $sql = "SELECT * FROM sitedb.Attribute";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $attributes[] = $row;
        }
        return $attributes;
    }
}

function getFilters($conn)
{
    $sql = "
        SELECT a.Name AS AttributeName, pa.Value
        FROM sitedb.product_attribute pa
        JOIN sitedb.attribute a ON pa.AttributeID = a.ID
        GROUP BY a.Name, pa.Value
        ORDER BY a.Name, pa.Value;
    ";

    $result = $conn->query($sql);

    $filters = [];
    if ($result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            $filters[$row['AttributeName']][] = $row['Value'];
        }
    }

    return $filters; // 2d array of attributes with array of distinct values inside 
}

function writeAllAttributes($conn)
{
    $filters = getFilters($conn);

    if (!empty($filters)) 
    {
        echo "<form method='GET'>";
        foreach ($filters as $attribute => $values) 
        {
            echo "<h5>$attribute</h5>";
            foreach ($values as $value) 
            {
                $checked = (isset($_GET[$attribute]) && in_array($value, $_GET[$attribute])) ? 'checked' : '';

                echo "<label>
                        <input type='checkbox' name='{$attribute}[]' value='$value' $checked> $value
                    </label><br>";
            }
        }
        echo "<button type='submit'>Filter</button>";
        echo "</form>";
    }
    else 
    {
        return;
    }   
}

function getAllProducts($conn)
{
    $sql = "SELECT * FROM sitedb.Product";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $products[] = $row;
        }
        return $products;
    }
}


function writeAllProducts($products)
{
    foreach ($products as $product) {
            $image = $product['Image'];
            $name = $product['Name'];
            $price = $product['Price'];

            echo "<div class='col-lg-4 col-md-4 col-sm-6 mb-4'>                               
                            <div class='product-container position-relative'>
                                <a href='#' class='mx-auto'>
                                    <img src='.//images/$image' alt='nazwa-zdjecia' class='img-fluid'>
                                </a>
                                <h5 class='mt-2'>$name</h5>
                                <p>Cena: $price zł</p>                    
                                <p>inne dane</p>
                                <div class='d-flex position-absolute bottom-0 end-0 mb-3 me-3'>
                                    <button type='#' class='btn btn-link me-1'>
                                        <i class='bi bi-heart fs-5'></i>
                                    </button>
                                    <button type='#' class='btn custom-btn'>
                                        <i class='bi bi-cart fs-5'></i>
                                    </button>
                                </div>
                            </div>
                        </div>";       
                    }
}

function getAllowedAttributes($conn)
{
    $sql = "SELECT DISTINCT Name FROM sitedb.Attribute";
    $result = $conn->query($sql);

    $attributes = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $attributes[] = $row['Name'];
        }
    }
    return $attributes;
}

function getURLfilters($conn)
{
    $filters = [];
    $allowedAttributes = getAllowedAttributes($conn);

    if (!empty($_GET)) {
        foreach ($_GET as $key => $values) {
            if (in_array($key, $allowedAttributes)) {
                $filters[$key] = is_array($values) ? $values : [$values];
            }
        }
        return $filters;
    }
    return [];
}

function getFilteredProducts($site_conn, $filters) 
{
    //DEFAULT QUERY
    $sql = "                            
        SELECT DISTINCT p.* 
        FROM sitedb.Product p
        WHERE 1=1
    ";

    $conditions = [];
    $params = [];
    $types = "";

    foreach ($filters as $key => $values) 
    {
        // Создаем плейсхолдеры для значений
        $placeholders = implode(',', array_fill(0, count($values), '?')); // number of ? signs from 0 to num of attribute VALUES!!

        // subquery for the specific attribute  
        $conditions[] = "
            p.ID IN (
                SELECT pa.ProductID 
                FROM sitedb.product_attribute pa
                INNER JOIN sitedb.Attribute a ON pa.AttributeID = a.ID
                WHERE a.Name = ? AND pa.Value IN ($placeholders)
            )
        ";

        
        $types .= 's' . str_repeat('s', count($values)); // get the correct num of 's' for future use in bind_param function
        $params[] = $key; // attribute name. Will be put into the stmt "WHERE a.Name = ?" (line 306)
        foreach ($values as $value) 
        {
            $params[] = $value;   // add firstly attribute name and then values 
        }
    }

    /*  
        Do zapytania sql przekazywana jest tablica parametrów $params = ['color', 'red', 'blue'], gdzie:
        Pierwszy parametr posłuży do filtrowania po nazwie atrybutu (a.Name = ?), czyli wartości „color”.
        Poniższe parametry służą do filtrowania według wartości atrybutów (pa.Value IN (?, ?)), czyli wartości „red” i „blue”.
    */

    if (!empty($conditions)) 
    {
        $sql .= " AND " . implode(" AND ", $conditions); // concatenate some additional specifications to the default query
    }

    $stmt = $site_conn->prepare($sql);

    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $products = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

    return $products;
}
?>