<?php
include '../assets/db/db_connect.php'; // adjust path if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Inventory Warehouse</title>
    <link rel="stylesheet" href="../assets/warehouse_inventory.css">
    <script src="../assets/warehouse_inventory.js" defer></script>
</head>
<body>
    <h2>Warehouse Inventory & Distribution</h2>

    <!-- Dashboard Summary Cards -->
    <div class="dashboard-cards">
      <div class="dashboard-card">
        <h3>Total Items</h3>
        <p id="total-items">120</p>
      </div>
      <div class="dashboard-card">
        <h3>Low Stock</h3>
        <p id="low-stock">5</p>
      </div>
      <div class="dashboard-card">
        <h3>Recent Distributions</h3>
        <p id="recent-distributions">8</p>
      </div>
    </div>

    <!-- Inventory Table -->
    <div>
      <button onclick="openAddModal()">Add New Item</button>
      <input type="text" id="search" placeholder="Search items..." class="search-input">
      <table class="inventory-table">
        <thead>
          <tr>
            <th>Item Name</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Location</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM inventory"; // change table name if needed
          $result = $conn->query($sql);

          if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                  echo "<td>" . (int)$row['quantity'] . "</td>";
                  echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                  echo "<td>
                          <button onclick='openDistributeModal()'>Distribute</button>
                          <button>Edit</button>
                        </td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='6'>No inventory items found.</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>

    <!-- Add Item Modal (hidden by default) -->
    <div id="addModal" class="modal">
      <h3>Add New Item</h3>
      <form>
        <label>Item Name: <input type="text"></label><br><br>
        <label>Category: <input type="text"></label><br><br>
        <label>Quantity: <input type="number"></label><br><br>
        <label>Location: <input type="text"></label><br><br>
        <button type="submit">Save</button>
        <button type="button" onclick="closeAddModal()">Cancel</button>
      </form>
    </div>

    <!-- Distribute Item Modal (hidden by default) -->
    <div id="distributeModal" class="modal">
      <h3>Distribute Item</h3>
      <form>
        <label>Recipient (Driver/Staff): <input type="text"></label><br><br>
        <label>Quantity: <input type="number"></label><br><br>
        <button type="submit">Distribute</button>
        <button type="button" onclick="closeDistributeModal()">Cancel</button>
      </form>
    </div>

</body>
</html>
