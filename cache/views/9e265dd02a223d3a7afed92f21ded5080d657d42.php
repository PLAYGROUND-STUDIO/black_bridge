<html lang="th">
<head>
    <style>
        .lds-ring {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }
        .lds-ring div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 64px;
            height: 64px;
            margin: 8px;
            border: 8px solid;
            border-radius: 50%;
            animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: #000 transparent transparent transparent;
        }
        .lds-ring div:nth-child(1) {
            animation-delay: -0.45s;
        }
        .lds-ring div:nth-child(2) {
            animation-delay: -0.3s;
        }
        .lds-ring div:nth-child(3) {
            animation-delay: -0.15s;
        }
        @keyframes  lds-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .show
        {
            margin-top: 30vh;
            text-align:center;
            font-family: 'K2D', sans-serif;
        }
    </style><title>Redirect</title>
</head>
<body>
<div class="show">
    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
    <h1>Redirecting</h1>
    <p>...กรุณารอสักครู่...</p>
</div>

<form action="<?php echo e($url); ?>" name="fire" method="post">
    <?php $__currentLoopData = $params; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</form>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.forms['fire'].submit()
    });
</script>
</body>
</html><?php /**PATH /Volumes/2nd Storage [LS]/Public Repositories/black_bridge/resources/views/post_redirect_html.blade.php ENDPATH**/ ?>