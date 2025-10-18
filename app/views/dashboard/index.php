<?php $title = 'Dashboard'; $pageJS = ['dashboard'];?>
<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card profile-badge">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <h3 class="mb-2"><?php echo htmlspecialchars($_SESSION['username']); ?></h3>
                <p class="mb-0 opacity-75">
                    <i class="fas fa-envelope"></i> <?php echo htmlspecialchars($_SESSION['email']); ?>
                </p>
            </div>
        </div>
        
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-body p-4">
                    <h4 class="mb-4"><i class="fas fa-info-circle text-primary"></i> Informasi Profil</h4>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <small class="text-muted d-block">Username</small>
                                <strong><?php echo htmlspecialchars($user['username']); ?></strong>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <small class="text-muted d-block">Email</small>
                                <strong><?php echo htmlspecialchars($user['email']); ?></strong>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <small class="text-muted d-block">User ID</small>
                                <strong>#<?php echo $user['id']; ?></strong>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <small class="text-muted d-block">Terdaftar Sejak</small>
                                <strong><?php echo date('d M Y', strtotime($user['created_at'])); ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">
                    <h4 class="mb-4"><i class="fas fa-rocket text-primary"></i> Quick Actions</h4>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="/webdemo_mvc/items" class="btn btn-outline-primary w-100 p-3">
                                <i class="fas fa-box fa-2x mb-2 d-block"></i>
                                Kelola Items
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="/webdemo_mvc/items/create" class="btn btn-outline-success w-100 p-3">
                                <i class="fas fa-plus-circle fa-2x mb-2 d-block"></i>
                                Tambah Item Baru
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="/webdemo_mvc/logout" class="btn btn-outline-danger w-100 p-3">
                                <i class="fas fa-sign-out-alt fa-2x mb-2 d-block"></i>
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>