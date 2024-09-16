</div>
</main>
<footer class="footer mt-auto py-3 bg-secondary-subtle text-center">
    <div class="container">
        © <span class="fw-bold">albums</span> <?= date('Y') ?>
    </div>
</footer>

<?php foreach ($args['before-closing-body'] ?? [] as $item) { ?>
    <?= $item ?>
<?php } ?>

<script defer src="<?= '/assets/scripts/' . get_hashed_scripts_file_name() ?>"></script>
</body>
</html>