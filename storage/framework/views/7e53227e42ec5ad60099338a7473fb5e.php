<?php $__env->startSection('title', $car->title . ' - ThriftMotors'); ?>

<?php $__env->startPush('styles'); ?>
<style>
[x-cloak] { display: none !important; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        
        <div class="lg:col-span-2">
            
            <div x-data="{ 
                    activeImage: 0, 
                    images: [<?php echo $car->images->map(fn($img) => "'".$img->image_url."'")->join(','); ?>],
                    next() { this.activeImage = (this.activeImage + 1) % this.images.length },
                    prev() { this.activeImage = (this.activeImage - 1 + this.images.length) % this.images.length }
                }" class="mb-8">
                <div class="mb-4 bg-gray-100 dark:bg-gray-800 rounded-lg overflow-hidden relative group border border-transparent dark:border-gray-700">
                    <?php if($car->images->count() > 0): ?>
                        <img :src="images[activeImage]"
                             class="w-full h-[500px] object-cover transition duration-300"
                             alt="<?php echo e($car->title); ?>">
                             
                        <?php if($car->images->count() > 1): ?>
                            <!-- Arrows -->
                            <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-black bg-opacity-50 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-red-600 transition opacity-0 group-hover:opacity-100">
                                <i class="fas fa-chevron-left text-xl"></i>
                            </button>
                            <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black bg-opacity-50 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-red-600 transition opacity-0 group-hover:opacity-100">
                                <i class="fas fa-chevron-right text-xl"></i>
                            </button>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="w-full h-[500px] flex items-center justify-center bg-gray-200 dark:bg-gray-800">
                            <i class="fas fa-image text-gray-400 dark:text-gray-600 text-5xl"></i>
                        </div>
                    <?php endif; ?>

                    
                    <?php if($car->status === 'reserved'): ?>
                        <div class="absolute top-4 left-4 bg-orange-500 text-white px-4 py-2 rounded-full font-bold text-sm uppercase tracking-wide shadow-lg">
                            <i class="fas fa-lock mr-1"></i> Reserved
                        </div>
                    <?php elseif($car->status === 'sold'): ?>
                        <div class="absolute top-4 left-4 bg-red-700 text-white px-4 py-2 rounded-full font-bold text-sm uppercase tracking-wide shadow-lg">
                            <i class="fas fa-check-circle mr-1"></i> Sold
                        </div>
                    <?php else: ?>
                        <div class="absolute top-4 left-4 bg-green-500 text-white px-4 py-2 rounded-full font-bold text-sm uppercase tracking-wide shadow-lg">
                            <i class="fas fa-circle mr-1"></i> Available
                        </div>
                    <?php endif; ?>
                </div>

                <?php if($car->images->count() > 1): ?>
                    <div class="grid grid-cols-6 gap-2">
                        <?php $__currentLoopData = $car->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button @click="activeImage = <?php echo e($index); ?>"
                                    :class="{ 'ring-2 ring-red-600': activeImage === <?php echo e($index); ?> }"
                                    class="rounded-lg overflow-hidden border-2 border-gray-300 dark:border-gray-600">
                                <img src="<?php echo e($image->image_url); ?>" alt="Thumbnail" class="w-full h-16 object-cover">
                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 mb-6 transition-colors duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h1 class="text-3xl font-bold mb-2 dark:text-white"><?php echo e($car->title); ?></h1>
                        <p class="text-gray-600 dark:text-gray-400">
                            <i class="fas fa-clock mr-2"></i>Listed <?php echo e($car->created_at->diffForHumans()); ?>

                        </p>
                    </div>
                    <?php if($car->statusBadge): ?>
                        <span class="bg-yellow-500 text-white px-4 py-2 rounded-full font-semibold">
                            <?php echo e($car->statusBadge); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                    <div><p class="text-gray-600 dark:text-gray-400 text-sm">Year</p><p class="text-xl font-semibold dark:text-gray-200"><?php echo e($car->year); ?></p></div>
                    <div><p class="text-gray-600 dark:text-gray-400 text-sm">Mileage</p><p class="text-xl font-semibold dark:text-gray-200"><?php echo e(number_format($car->mileage)); ?> km</p></div>
                    <div><p class="text-gray-600 dark:text-gray-400 text-sm">Color</p><p class="text-xl font-semibold dark:text-gray-200"><?php echo e($car->color); ?></p></div>
                    <div><p class="text-gray-600 dark:text-gray-400 text-sm">Seats</p><p class="text-xl font-semibold dark:text-gray-200"><?php echo e($car->seats); ?></p></div>
                </div>
            </div>

            
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 mb-6 transition-colors duration-300">
                <h2 class="text-2xl font-bold mb-4 dark:text-white">Specifications</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="border-l-4 border-red-600 pl-4 py-2">
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Brand</p><p class="font-semibold dark:text-gray-200"><?php echo e($car->brand->name); ?></p>
                    </div>
                    <div class="border-l-4 border-red-600 pl-4 py-2">
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Fuel Type</p><p class="font-semibold dark:text-gray-200"><?php echo e($car->fuelType->name); ?></p>
                    </div>
                    <div class="border-l-4 border-red-600 pl-4 py-2">
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Transmission</p><p class="font-semibold dark:text-gray-200"><?php echo e($car->transmission->name); ?></p>
                    </div>
                </div>
            </div>

            
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 transition-colors duration-300">
                <h2 class="text-2xl font-bold mb-4 dark:text-white">Description</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed"><?php echo e($car->description); ?></p>
                <?php if($car->features && is_array($car->features) && count($car->features) > 0): ?>
                    <h3 class="text-lg font-semibold mt-6 mb-3 dark:text-white">Features</h3>
                    <ul class="grid grid-cols-2 gap-3">
                        <?php $__currentLoopData = $car->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="flex items-center dark:text-gray-300">
                                <i class="fas fa-check text-green-600 mr-2"></i> <?php echo e($feature); ?>

                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>

        
        <aside class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-6 mb-6 sticky top-20 transition-colors duration-300">
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">Price</p>
                <p class="text-4xl font-bold text-red-600 dark:text-red-500 mb-1">KES <?php echo e(number_format($car->price, 0)); ?></p>
                <?php if($car->is_negotiable): ?>
                    <p class="text-green-600 font-semibold mb-4"><i class="fas fa-handshake mr-2"></i>Negotiable</p>
                <?php endif; ?>

                
                <?php if($car->status === 'reserved'): ?>
                    <div class="bg-orange-50 dark:bg-orange-900/30 border border-orange-300 dark:border-orange-700 text-orange-800 dark:text-orange-400 rounded-lg p-3 mb-4 text-sm">
                        <i class="fas fa-lock mr-2"></i><strong>Reserved</strong> — This car is currently reserved.
                    </div>
                <?php elseif($car->status === 'sold'): ?>
                    <div class="bg-red-50 dark:bg-red-900/30 border border-red-300 dark:border-red-700 text-red-800 dark:text-red-400 rounded-lg p-3 mb-4 text-sm">
                        <i class="fas fa-times-circle mr-2"></i><strong>Sold</strong> — This car is no longer available.
                    </div>
                <?php endif; ?>

                
                <div class="space-y-3 mb-4">
                    
                    <?php if($car->status === 'available'): ?>
                        <?php if(auth()->guard()->check()): ?>
                            <button
                                x-data
                                @click="$dispatch('open-reservation-modal')"
                                class="block w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition font-bold text-center text-lg shadow-lg">
                                <i class="fas fa-key mr-2"></i> Reserve This Car
                            </button>
                            <p class="text-center text-xs text-gray-500">
                                <i class="fas fa-shield-alt mr-1 text-green-600"></i>
                                KES <?php echo e(number_format(config('thriftmotors.deposit_amount', 5000))); ?> deposit · Secured for 14 days
                            </p>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="block w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition font-bold text-center text-lg shadow-lg">
                                <i class="fas fa-sign-in-alt mr-2"></i> Login to Reserve
                            </a>
                            <p class="text-center text-xs text-gray-500">
                                You must be logged in to make a reservation.
                            </p>
                        <?php endif; ?>
                    <?php endif; ?>

                    
                    <a href="https://wa.me/<?php echo e(preg_replace('/\D/', '', $car->seller_whatsapp ?? $car->seller_phone)); ?>?text=<?php echo e(urlencode('Hi, I am interested in the '.$car->title.' on ThriftMotors. Price: KES '.$car->price)); ?>"
                       target="_blank"
                       class="block w-full bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 transition font-semibold text-center">
                        <i class="fab fa-whatsapp mr-2"></i> WhatsApp Seller
                    </a>

                    <a href="tel:<?php echo e($car->seller_phone); ?>"
                       class="block w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold text-center">
                        <i class="fas fa-phone mr-2"></i> Call Seller
                    </a>

                    <button onclick="document.getElementById('inquiryModal').classList.remove('hidden')"
                            class="w-full bg-gray-700 text-white py-3 rounded-lg hover:bg-gray-800 transition font-semibold">
                        <i class="fas fa-envelope mr-2"></i> Send Inquiry
                    </button>
                </div>

                
                <div class="border-t dark:border-gray-700 pt-4 mt-6">
                    <h3 class="font-bold mb-2 text-sm uppercase tracking-wide text-gray-500 dark:text-gray-400">Seller</h3>
                    <p class="font-semibold dark:text-white"><?php echo e($car->seller_name); ?></p>
                    <a href="tel:<?php echo e($car->seller_phone); ?>" class="text-red-600 dark:text-red-400 hover:underline text-sm"><?php echo e($car->seller_phone); ?></a>
                </div>
            </div>
        </aside>
    </div>

    
    <?php if($relatedCars->count() > 0): ?>
        <section class="mt-16">
            <h2 class="text-3xl font-bold mb-6">Similar Cars</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php $__currentLoopData = $relatedCars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedCar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginalddff77940a067fc12b4449e98aa924a9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalddff77940a067fc12b4449e98aa924a9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.car-card','data' => ['car' => $relatedCar]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('car-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['car' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($relatedCar)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalddff77940a067fc12b4449e98aa924a9)): ?>
<?php $attributes = $__attributesOriginalddff77940a067fc12b4449e98aa924a9; ?>
<?php unset($__attributesOriginalddff77940a067fc12b4449e98aa924a9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalddff77940a067fc12b4449e98aa924a9)): ?>
<?php $component = $__componentOriginalddff77940a067fc12b4449e98aa924a9; ?>
<?php unset($__componentOriginalddff77940a067fc12b4449e98aa924a9); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
    <?php endif; ?>
</div>


<div
    x-data="reservationModal(<?php echo e($car->id); ?>, '<?php echo e(addslashes($car->title)); ?>')"
    x-show="open"
    x-cloak
    @open-reservation-modal.window="openModal()"
    @keydown.escape.window="closeModal()"
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    style="display:none">

    
    <div class="absolute inset-0 bg-black bg-opacity-60" @click="closeModal()"></div>

    
    <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md z-10 border border-transparent dark:border-gray-700 transition-colors duration-300" @click.stop>

        
        <div class="flex items-center justify-between p-6 border-b dark:border-gray-700">
            <div>
                <h3 class="text-xl font-bold dark:text-white">Reserve This Car</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1"><?php echo e($car->title); ?></p>
            </div>
            <button @click="closeModal()" class="text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-2xl leading-none">&times;</button>
        </div>

        
        <div x-show="step === 'form'" class="p-6 space-y-5">
            
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/50 rounded-xl p-4">
                <div class="flex items-center gap-3">
                    <div class="text-3xl font-bold text-red-600 dark:text-red-500">
                        KES <?php echo e(number_format(config('thriftmotors.deposit_amount', 5000))); ?>

                    </div>
                    <div class="text-sm text-red-700 dark:text-red-400">
                        <p class="font-semibold">Reservation Deposit</p>
                        <p>Secures this car for <strong>14 days</strong></p>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1 dark:text-gray-300">Your Name *</label>
                <input type="text" x-model="name" placeholder="John Doe"
                       class="w-full px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white dark:placeholder-gray-400">
                <p x-show="errors.customer_name" x-text="errors.customer_name" class="text-red-600 dark:text-red-400 text-xs mt-1"></p>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1 dark:text-gray-300">M-Pesa Phone Number *</label>
                <input type="tel" x-model="phone" placeholder="0712 345 678"
                       class="w-full px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white dark:placeholder-gray-400">
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Kenyan number, e.g. 0712345678</p>
                <p x-show="errors.phone" x-text="errors.phone" class="text-red-600 dark:text-red-400 text-xs mt-1"></p>
            </div>

            <p x-show="generalError" x-text="generalError" class="bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-sm p-3 rounded-lg border border-red-200 dark:border-red-800"></p>

            <button @click="submit()" :disabled="loading"
                    class="w-full bg-red-600 text-white py-3 rounded-xl font-bold text-lg hover:bg-red-700 transition disabled:opacity-60 flex items-center justify-center gap-2">
                <template x-if="loading">
                    <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                    </svg>
                </template>
                <span x-text="loading ? 'Initiating…' : 'Pay Deposit via M-Pesa'"></span>
            </button>

            <p class="text-center text-xs text-gray-400">
                <i class="fas fa-shield-alt text-green-600 mr-1"></i>
                Secured by M-Pesa · No card required
            </p>
        </div>

        
        <div x-show="step === 'waiting'" class="p-8 text-center space-y-6">
            <div class="flex justify-center">
                <div class="w-20 h-20 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                    <svg class="animate-spin h-10 w-10 text-green-600 dark:text-green-500" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <h4 class="text-xl font-bold text-gray-800 dark:text-white">Check Your Phone</h4>
                <p class="text-gray-600 dark:text-gray-400 mt-2">An M-Pesa prompt has been sent to <strong x-text="phone" class="dark:text-gray-200"></strong>.</p>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Enter your <strong>M-Pesa PIN</strong> to complete the reservation.</p>
            </div>
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800/50 rounded-xl p-4 text-sm text-green-800 dark:text-green-400">
                <i class="fas fa-info-circle mr-1"></i>
                This page will update automatically once payment is confirmed.
            </div>
            <button @click="closeModal()" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 text-sm underline">
                Cancel
            </button>
        </div>

        
        <div x-show="step === 'success'" class="p-8 text-center space-y-6">
            <div class="flex justify-center">
                <div class="w-20 h-20 rounded-full bg-green-500 flex items-center justify-center">
                    <i class="fas fa-check text-white text-4xl"></i>
                </div>
            </div>
            <div>
                <h4 class="text-2xl font-bold text-green-700 dark:text-green-500">Car Reserved! 🎉</h4>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Your deposit was received. This car is now secured for <strong>14 days</strong>.</p>
            </div>
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800/50 rounded-xl p-4 text-sm text-green-800 dark:text-green-400">
                <i class="fas fa-calendar-alt mr-1"></i>
                Expires: <strong x-text="expiresAt" class="dark:text-green-300"></strong>
            </div>
            <a :href="whatsappUrl" target="_blank"
               class="block w-full bg-green-500 text-white py-3 rounded-xl font-bold hover:bg-green-600 transition">
                <i class="fab fa-whatsapp mr-2"></i> Message Seller to Schedule Viewing
            </a>
            <button @click="closeModal()" class="block w-full text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 text-sm underline">
                Close
            </button>
        </div>

        
        <div x-show="step === 'error'" class="p-8 text-center space-y-6">
            <div class="flex justify-center">
                <div class="w-20 h-20 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                    <i class="fas fa-times text-red-600 dark:text-red-500 text-4xl"></i>
                </div>
            </div>
            <div>
                <h4 class="text-xl font-bold text-red-700 dark:text-red-500">Payment Not Completed</h4>
                <p class="text-gray-600 dark:text-gray-400 mt-2" x-text="generalError"></p>
            </div>
            <button @click="step = 'form'; generalError = ''"
                    class="w-full bg-red-600 text-white py-3 rounded-xl font-bold hover:bg-red-700 transition">
                Try Again
            </button>
            <button @click="closeModal()" class="block w-full text-gray-500 dark:text-gray-400 text-sm underline">Cancel</button>
        </div>
    </div>
</div>


<div id="inquiryModal" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4 transition-opacity">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full border border-transparent dark:border-gray-700">
        <div class="p-6 border-b dark:border-gray-700 flex justify-between items-center">
            <h3 class="text-xl font-bold dark:text-white">Send Inquiry</h3>
            <button onclick="document.getElementById('inquiryModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-2xl leading-none">&times;</button>
        </div>
        <form action="<?php echo e(route('inquiries.store', $car)); ?>" method="POST" class="p-6 space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Name *</label>
                <input type="text" name="customer_name" required
                       class="w-full px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Email *</label>
                <input type="email" name="customer_email" required
                       class="w-full px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Phone *</label>
                <input type="tel" name="customer_phone" required
                       class="w-full px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Message</label>
                <textarea name="message" rows="3"
                          class="w-full px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white dark:placeholder-gray-400"
                          placeholder="Tell the seller more about your interest…"></textarea>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="flex-1 bg-red-600 text-white py-3 rounded-xl hover:bg-red-700 font-bold transition">Send Inquiry</button>
                <button type="button" onclick="document.getElementById('inquiryModal').classList.add('hidden')"
                        class="flex-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 py-3 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 font-bold transition">Cancel</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function reservationModal(carId, carTitle) {
    return {
        open: false,
        step: 'form',   // form | waiting | success | error
        loading: false,
        name: '',
        phone: '',
        errors: {},
        generalError: '',
        reservationId: null,
        whatsappUrl: '',
        expiresAt: '',
        pollTimer: null,

        openModal() {
            this.open = true;
            this.step = 'form';
            this.errors = {};
            this.generalError = '';
        },

        closeModal() {
            this.open = false;
            this.stopPolling();
        },

        async submit() {
            this.loading = true;
            this.errors = {};
            this.generalError = '';

            try {
                const res = await fetch(`/cars/${carId}/reserve`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ customer_name: this.name, phone: this.phone }),
                });

                const data = await res.json();

                if (res.status === 422 && data.errors) {
                    this.errors = data.errors;
                    return;
                }

                if (data.success) {
                    this.reservationId = data.reservation_id;
                    this.whatsappUrl   = data.whatsapp_url;
                    this.step = 'waiting';
                    this.startPolling();
                } else {
                    this.generalError = data.message ?? 'Something went wrong. Please try again.';
                    this.step = 'error';
                }
            } catch (e) {
                this.generalError = 'Network error. Please check your connection and try again.';
                this.step = 'error';
            } finally {
                this.loading = false;
            }
        },

        startPolling() {
            this.pollTimer = setInterval(async () => {
                try {
                    const res  = await fetch(`/reservations/${this.reservationId}/status`);
                    const data = await res.json();

                    if (data.paid) {
                        this.stopPolling();
                        this.expiresAt = data.expires_at ?? '';
                        this.step = 'success';
                        // Refresh page badge after short delay
                        setTimeout(() => location.reload(), 8000);
                    } else if (['cancelled', 'expired'].includes(data.status)) {
                        this.stopPolling();
                        this.generalError = 'Payment was not completed or was cancelled.';
                        this.step = 'error';
                    }
                } catch (_) { /* silent — keep polling */ }
            }, 5000);

            // Give up after 3 minutes
            setTimeout(() => {
                if (this.step === 'waiting') {
                    this.stopPolling();
                    this.generalError = 'Payment confirmation timed out. If you paid, contact us with your M-Pesa receipt.';
                    this.step = 'error';
                }
            }, 180000);
        },

        stopPolling() {
            if (this.pollTimer) {
                clearInterval(this.pollTimer);
                this.pollTimer = null;
            }
        },
    };
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\thriftmotors\resources\views/pages/car-detail.blade.php ENDPATH**/ ?>