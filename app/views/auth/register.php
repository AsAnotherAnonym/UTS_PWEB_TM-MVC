<?php $title = 'Register'; ?>
<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-container">
    <div class="auth-card card">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <i class="fas fa-user-plus fa-3x text-primary mb-3"></i>
                <h2 class="fw-bold">Create Account</h2>
                <p class="text-muted">Daftar akun baru</p>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="/webdemo_mvc/register">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" name="confirm_password" required>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 mb-3">
                    <i class="fas fa-user-plus"></i> Daftar
                </button>
                
                <div class="text-center">
                    <p class="mb-0">Sudah punya akun? <a href="/webdemo_mvc/login" class="text-primary fw-bold">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>