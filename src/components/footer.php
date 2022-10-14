        <div class="footer">
            <p class="centered-contents">2022 DiversMap</p>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.0/dist/semantic.min.js"></script>
        <script src="/js/hamburger.js"></script>
        <?php
            if (isset($js)) {
                foreach ($js as $child) {
                    echo "<script src=\"{$child}\"></script>";
                }
            }
        ?>
    </body>
</html>