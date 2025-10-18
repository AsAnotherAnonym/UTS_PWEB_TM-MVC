<?php $title = 'Edit Item'; ?>
<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0"><i class="fas fa-edit text-warning"></i> Edit Item</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="/webdemo_mvc/items/update">
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Item</label>
                            <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($item['name']); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="4" required><?php echo htmlspecialchars($item['description']); ?></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" name="price" value="<?php echo $item['price']; ?>" required>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="/webdemo_mvc/items" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>