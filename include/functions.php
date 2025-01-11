<?php
function authorisedUser(){
    if(isset($_SESSION['ID'])){
        return $_SESSION['ID'];
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

function getUser($conn, $login){
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

function getUserAddress($conn, $login)
{
    $sql = "SELECT * FROM clientdb.address
            JOIN clientdb.user ON clientdb.user.ID = clientdb.address.UserID
            WHERE clientdb.user.Login = ? AND clientdb.address.Type = 'shipping'";
    
    $query = $conn->prepare($sql);
    $query->bind_param('s', $login);
    $query->execute();

    $result = $query->get_result();
    $address = $result->fetch_assoc();
    return $address;
}

function getBillingAddress($conn, $login)
{
    $sql = "SELECT * FROM clientdb.address
            JOIN clientdb.user ON clientdb.user.ID = clientdb.address.UserID
            WHERE clientdb.user.Login = ? AND clientdb.address.Type = 'billing'";
    
    $query = $conn->prepare($sql);
    $query->bind_param('s', $login);
    $query->execute();

    $result = $query->get_result();
    $address = $result->fetch_assoc();
    return $address;
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
        if($_GET['error'] === 'changenone')
        {
            echo '<div class="alert alert-success" role="alert">
                    Dane zostały zmienione!
                  </div>';
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
        $_SESSION['login'] = $row['Login'];
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

function getProduct($conn, $id)
{
    $sql = "SELECT * FROM sitedb.product
            WHERE sitedb.product.ID = ?
            ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    if($product)
    {
        return $product;
    }
    else return 0;
}

function getAllCategories($conn)
{
    $sql = "SELECT * FROM sitedb.Category";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $categories[] = $row;
        }
        return $categories;
    }
}

function writeAllCategories($conn)
{
    $categories = getAllCategories($conn);
    echo "<h4 class='border-bottom pb-2 ps-2'><strong>Kategorie</strong></h4>";
    foreach($categories as $category)
    {
        $name = $category['Name'];
        if(!empty($_GET['input']))
        {
            $input = $_GET['input'];
            echo "<a href='sklep?Category=$name&input=$input'>$name</a><br>";
        }
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

function getTechData($conn, $id)
{
    $sql = "
        SELECT a.Name AS AttributeName, pa.Value
        FROM sitedb.product_attribute pa
        JOIN sitedb.attribute a ON pa.AttributeID = a.ID
        WHERE (pa.ProductID = ?)
        GROUP BY a.Name, pa.Value
        ORDER BY a.Name, pa.Value;
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    if ($result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            $data[$row['AttributeName']][] = $row['Value'];
        }
    }

    return $data; // 2d array of attributes with array of distinct values inside 
}

function writeTechData($conn, $id) 
{
    $data = getTechData($conn, $id);

    foreach ($data as $attribute => $values) 
        {
            foreach ($values as $value) 
            {
                echo "<h3>{$attribute}</h3>
                      <p>$value</p>"; 
            }
        }
}


function getFilters($conn, $category)
{
    $sql = "
        SELECT a.Name AS AttributeName, pa.Value
        FROM sitedb.product_attribute pa
        JOIN sitedb.attribute a ON pa.AttributeID = a.ID
        JOIN sitedb.product p ON pa.ProductID = p.ID
        JOIN sitedb.Category c ON p.CategoryID = c.ID
        WHERE (? IS NULL OR c.Name = ?)
        GROUP BY a.Name, pa.Value
        ORDER BY a.Name, pa.Value;
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $category, $category);
    $stmt->execute();
    $result = $stmt->get_result();

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
    if (isset($_GET['Category'])) 
        {
            $category = htmlspecialchars($_GET['Category']);
        }
        else
        {
            $category = null;
        }

    $filters = getFilters($conn, $category);

    if (!empty($filters)) 
    {
        echo "<h4 class='border-bottom pb-2 ps-2'><strong>Filtry</strong></h4>
              <form class='px-2' method='GET'>";

        if (isset($_GET['Category'])) 
        {
            echo "<input type='hidden' name='Category' value='$category'>"; // adding category parameter to url by sending hidden input via form
        }

        foreach ($filters as $attribute => $values) 
        {
            echo "<h5>$attribute</h5>";
            foreach ($values as $value) 
            {
                $checked = (isset($_GET[$attribute]) && in_array($value, $_GET[$attribute])) ? 'checked' : '';

                echo "<input class='form-check-input mb-2' type='checkbox' name='{$attribute}[]' value='$value' $checked> $value
                    <br>";
            }
        }
        echo "
        <div class='d-flex justify-content-center'>
        <button type='submit' class='btn custom-btn rounded-0 my-2 w-100'>Pokaż wyniki filtrowania</button>
        </div>";
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
    echo "<div class='row'>";

    foreach ($products as $product) {
        $id = $product['ID'];
        $image = $product['Image'];
        $name = $product['Name'];
        $price = $product['Price'];

    echo "<div class='col-lg-4 col-md-4 col-sm-6 mb-4'>
    <div class='product-container' style='background-color: white; height: 400px;'>      
        <!-- kontener na zdjęcie produktu -->
        <a href='produktDane?id=$id' class='mx-auto' style='flex-shrink: 0; height: 200px;'>
            <img src='./images/$image' alt='nazwa-zdjecia' class='img-fluid' style='object-fit: cover; width: 100%; height: 100%;'>
        </a>       
        <!-- informacje na temat produktu  -->
        <div class='px-3' style='flex-grow: 1;'>
            <div style='text-align: center;'>
                <h5>$name</h5>
            </div>
            <p>inne dane</p>
        </div>       
        <!-- footer z przyciskami i ceną -->
        <div class='d-flex justify-content-evenly align-items-center mb-2'>
            <p class='mt-2 fs-5'><strong>$price zł</strong></p>
    
            <div class='d-flex'>
                <button type='#' class='btn btn-light me-2 rounded-0' style='width: 48px; height: 48px; display: flex; justify-content: center; align-items: center; color: #7b6dfa'>
                    <i class='bi bi-heart fs-3'></i>
                </button>
                <button type='#' class='btn custom-btn rounded-0' style='width: 48px; height: 48px; display: flex; justify-content: center; align-items: center;'>
                    <i class='bi bi-cart fs-5'></i>
                </button> 
            </div>
        </div>
    </div>
</div>

";
    }

    echo "</div>";
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
        if (isset($_GET['Category'])) {
            $filters['Category'] = [$_GET['Category']];
        }
        return $filters;
    }
    return [];
}


function getFilteredProducts($site_conn, $filters) 
{
    //CATEGORISED QUERY
    $sql = "                            
    SELECT DISTINCT p.* 
    FROM sitedb.Product p 
    INNER JOIN sitedb.Category c ON p.CategoryID = c.ID
    WHERE 1=1
    ";

    if (isset($filters['Category'])) 
    {
        $sql .= " AND c.Name = ?";
        $params[] = $filters['Category'][0]; // value of the category
        $types = "s";
    } 
    else 
    {
        $params = [];
        $types = "";
    }

    $conditions = [];
    

    foreach ($filters as $key => $values) 
    {
        if ($key === 'Category' || $key === 'input') {
            continue;
        }

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

function searchProducts($conn, $searchInput)
{
    $searchInput = "%" . $searchInput . "%";

    $sql = "SELECT * FROM sitedb.product
            WHERE sitedb.product.Name LIKE ?
            ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $searchInput);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    return $products;
}

function findCommon($arrX, $arrY)
{
    $result = [];

    foreach ($arrX as $itemX) 
    {
        foreach ($arrY as $itemY)
        {
            if ($itemX === $itemY) 
            {
                $result[] = $itemX;
            }
        }
    }
    return $result;
}

function getUserAddressByType($conn, $login, $type) 
{
    $stmt = $conn->prepare("SELECT * FROM clientdb.address WHERE UserID = (SELECT ID FROM clientdb.user WHERE Login = ?) AND Type = ?");
    $stmt->bind_param('ss', $login, $type);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function writeIfEmpty($string)
{
    if($string === "Brak")
    {
        echo "";
    }
    else echo "$string";
}
?>