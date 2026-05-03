<?php $__env->startComponent('mail::message'); ?>
# New Contact Message

You have received a new contact message from ThriftMotors.

**Name:** <?php echo new \Illuminate\Support\EncodedHtmlString($data['name']); ?>

**Email:** <?php echo new \Illuminate\Support\EncodedHtmlString($data['email']); ?>

**Phone:** <?php echo new \Illuminate\Support\EncodedHtmlString($data['phone']); ?>


**Message:**
<?php echo new \Illuminate\Support\EncodedHtmlString($data['message']); ?>


Thanks,<br>
<?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH F:\thriftmotors\resources\views/emails/contact.blade.php ENDPATH**/ ?>