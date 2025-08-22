<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Logistics Tracker</title>
    <link rel="stylesheet" href="../assets/project_tracker.css">
    <script src="../assets/project_tracker.css" defer></script>
</head>
<body>
    <h2>Project Logistics Tracker</h2>

    <button onclick="openProjectModal()">Add New Project Delivery</button>
    <table class="project-table">
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Item/Asset</th>
                <th>Delivery Status</th>
                <th>Assigned To</th>
                <th>Milestone/Phase</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dynamic rows here -->
        </tbody>
    </table>

    <!-- Add/Edit Project Delivery Modal -->
    <div id="projectModal" class="modal">
        <h3>Add/Edit Project Delivery</h3>
        <form>
            <label>Project Name: <input type="text"></label><br><br>
            <label>Item/Asset: <input type="text"></label><br><br>
            <label>Assigned To: <input type="text"></label><br><br>
            <label>Milestone/Phase: <input type="text"></label><br><br>
            <label>Delivery Status:
                <select>
                    <option>Pending</option>
                    <option>In Transit</option>
                    <option>Delivered</option>
                    <option>Returned</option>
                </select>
            </label><br><br>
            <label>Remarks: <input type="text"></label><br><br>
            <button type="submit">Save</button>
            <button type="button" onclick="closeProjectModal()">Cancel</button>
        </form>
    </div>