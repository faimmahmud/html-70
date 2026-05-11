    <footer class="site-footer">
        <div class="container-fluid px-3 px-lg-5">
            <div class="footer-grid">
                <div>
                    <p class="eyebrow">Private web atelier</p>
                    <h2>Built for presence, speed, and trust.</h2>
                </div>
                <div class="footer-meta">
                    <a href="#top">Back to top</a>
                    <a href="mailto:<?= e(SITE_EMAIL); ?>"><?= e(SITE_EMAIL); ?></a>
                    <span>&copy; <?= date('Y'); ?> <?= e(SITE_NAME); ?></span>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?= e(asset('vendor/jquery/jquery-3.7.1.min.js')); ?>"></script>
    <script src="<?= e(asset('vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?= e(asset('js/main.js')); ?>"></script>
</body>
</html>
