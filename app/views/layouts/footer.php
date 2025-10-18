    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        const BASE_URL = '<?php echo BASE_URL ?? "/webdemo_mvc"; ?>';
    </script>
    <script src="<?php echo BASE_URL ?? '/webdemo_mvc'; ?>/public/js/main.js"></script>
    
    <?php if (isset($pageJS)): ?>
        <?php foreach ($pageJS as $js): ?>
            <script src="<?php echo BASE_URL ?? '/webdemo_mvc'; ?>/public/js/<?php echo $js; ?>.js"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>