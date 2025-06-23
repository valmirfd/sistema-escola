<?php if (session()->has('success')): ?>
    <script>
        Toastify({
            text: "<?= session('success'); ?>",
            duration: 4500,
            //destination: "https://github.com/apvarun/toastify-js",
            //newWindow: true,
            close: true,
            gravity: "top",
            position: 'right',
            backgroundColor: '#4fbe87'
        }).showToast();
    </script>
<?php endif; ?>

<?php if (session()->has('info')): ?>
    <script>
        Toastify({
            text: "<?= session('info'); ?>",
            duration: 4500,
            close: true,
            gravity: "top",
            position: 'right',
            backgroundColor: '#3399FF'
        }).showToast();
    </script>
<?php endif; ?>

<?php if (session()->has('danger')): ?>
    <script>
        Toastify({
            text: "<?= session('danger'); ?>",
            duration: 4500,
            close: true,
            gravity: "top",
            position: 'right',
            backgroundColor: '#990000'
        }).showToast();
    </script>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <script>
        Toastify({
            text: "<?= session('error'); ?>",
            duration: 4500,
            close: true,
            gravity: "top",
            position: 'right',
            backgroundColor: '#990000'
        }).showToast();
    </script>
<?php endif; ?>