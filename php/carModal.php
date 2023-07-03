<!-- Modal box for adding a car -->
<div id="carModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Ajouter une voiture</p>
        
        <!-- Add a car form -->
        <form id="carForm" action="newCar.php" method="POST" enctype="multipart/form-data">
            <input type="text" class="brandInput" name="brand" placeholder="Marque" required><br>
            <input type="text" class="yearInput" name="year" placeholder="Année" required><br>
            <input type="text" class="priceInput" name="price" placeholder="Prix" required><br>
            <input type="text" class="mileageInput" name="mileage" placeholder="Kilométrage" required><br>
            <input type="file" class="imageInput" name="image" accept="image/*" required><br>
            
            <!-- Add car button -->
            <button type="submit" name="addCar">Ajouter</button>
        </form>
    </div>
</div>
