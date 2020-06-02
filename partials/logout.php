<p class="current_user">
    Logged in as: <?= $_SESSION['username']; ?>
    <span>Permissions: <?= implode(', ', array_keys($_SESSION['permissions'])); ?></span>
</p>
<form id='logout'>
    <button>Logout</button>
</form>
