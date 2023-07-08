<?php
$servername = "localhost";
$username = "root";
$dbPassword = "";
$database = "garage_v_parrot";
$table = "cars";
$uploadDirectory = "../uploads/";
        
// Create a database connection
$conn = new mysqli($servername, $username, $dbPassword, $database);
        
// Check the connection
if ($conn->connect_error) {
    die("Database connection error:" . $conn->connect_error);
    }
        
// Retrieve car data from the database
$sql = "SELECT id, brand, year, price, mileage, image FROM $table";
$result = $conn->query($sql);

// Check if the user is an administrator or a staff member 
if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'salary')) { ?>
    <button type="button" id="modify-car" class="modify-button">Modifier</button>
<?php   } 

// Delete the car and its corresponding image
if (isset($_GET['delete_id'])) {
            $deleteId = $_GET['delete_id'];

    // Select the image of the car to be deleted
    $selectImageQuery = "SELECT image FROM $table WHERE id = $deleteId";
            $selectImageResult = $conn->query($selectImageQuery);

            if ($selectImageResult->num_rows > 0) {
                $row = $selectImageResult->fetch_assoc();
                $imageToDelete = $row['image'];

        // Delete the car record from the database
        $deleteQuery = "DELETE FROM $table WHERE id = $deleteId";
                $deleteResult = $conn->query($deleteQuery);

                if ($deleteResult) {
            // Delete the image from the "uploads" directory
            unlink($uploadDirectory . $imageToDelete);
                }
            
                header('Location: admin.php');
            }
        }

?>

<section class="toSell">
    <div class="filters">
        <label for="sorting">Trier par :</label>
            <select id="sorting">
                <option value="alphabeticalGrowing">Ordre alphabétique</option>
                <option value="alphabeticalDescending">Ordre alphabétique D</option>
                <option value="priceGrowing">Prix</option>
                <option value="priceDescending">Prix D</option>
                <option value="mileageGrowing">Kilométrage</option>
                <option value="mileageDescending">Kilométrage D</option>
                <option value="yearGrowing">Année</option>
                <option value="yearDescending">Année D</option>
            </select>

            <p>Marque:</p>
                <input type="checkbox" class="carBrand" name="carBrandRenault" value="Renault">
                <label for="Brand">Renault<br></label>
      
                <input type="checkbox" class="carBrand" name="carBrandPeugeot" value="Peugeot">
                <label for="Brand">Peugeot<br></label>
      
                <input type="checkbox" class="carBrand" name="carBrandVolkswagen" value="Volkswagen">
                <label for="Brand">Volkswagen<br></label>

                <label for="year">Année:<br>
                    <input type="number" name="carYearCirculation" id="carYear" maxlength="4" placeholder="AAAA">
                    <br>
                </label>

                <label for="Price">Prix:<br>
                    <input type="number" name="carPrice" id="carPriceMin" placeholder="min."> 
                    <input type="number" name="carPrice" id="carPriceMax" placeholder="max."> 
                    <br>
                </label>

                <label for="Mileage">Kilométrage:<br>
                    <input type="number" name="carMileageMax" id="carMilesMax" placeholder="max.">
                    <br>
                </label>
    </div>
    
    <div class="filtered">
        <table>
            <thead>
                <tr>
                    <th>Marque</th>
                    <th>Année</th>
                    <th>Prix</th>
                    <th>Kilométrage</th>
                    <th>Image</th>
                </tr>
            </thead>

            <tbody>
            <?php
                    if ($result->num_rows > 0) {
                    // Display car data in the table
                    while ($row = $result->fetch_assoc()) {
                            echo "<tr class='expandable-row'>";
                            echo "<td>" . $row['brand'] . "</td>";
                            echo "<td>" . $row['year'] . "</td>";
                            echo "<td>" . $row['price'] . "€" . "</td>";
                            echo "<td>" . $row['mileage'] . "km" . "</td>";
                            echo "<td><img src='" . $uploadDirectory . $row['image'] . "' alt='photo de voiture'></td>";
                            if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'salary')) {
                                echo "<td><a href='?delete_id=" . $row['id'] . "' class='delete-car'>&times;</a></td>";
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Aucune voiture trouvée dans la base de données.</td></tr>";
                    }
                    ?>

            </tbody>
        </table>
    </div>
</section>

<?php
// Close the database connection
$conn->close();
?>
