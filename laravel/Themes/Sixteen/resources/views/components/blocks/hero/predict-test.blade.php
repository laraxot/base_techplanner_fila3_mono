{{--
Bootstrap Italia Hero Component for Predict Module
Enhanced hero section with Bootstrap Italia compliance
--}}

@props([
    'title' => 'Predict Analysis',
    'subtitle' => 'Advanced predictive analytics for data-driven decisions',
    'backgroundImage' => null,
    'ctaText' => 'Start Analysis',
    'ctaUrl' => '#',
    'type' => 'centered', // centered, image, background
    'size' => 'normal', // small, normal, large
    'showStats' => true,
    'stats' => []
])

@php
    $defaultStats = [
        [
            'value' => '98%',
            'label' => 'Accuracy Rate',
            'description' => 'Prediction accuracy across all models',
            'icon' => 'chart-bar'
        ],
        [
            'value' => '1.2M',
            'label' => 'Data Points',
            'description' => 'Total data points analyzed',
            'icon' => 'database'
        ],
        [
            'value' => '24/7',
            'label' => 'Monitoring',
            'description' => 'Continuous system monitoring',
            'icon' => 'clock'
        ],
        [
            'value' => '500ms',
            'label' => 'Response Time',
            'description' => 'Average prediction response time',
            'icon' => 'bolt'
        ]
    ];
    
    $displayStats = !empty($stats) ? $stats : $defaultStats;
@endphp

<x-bootstrap-italia.hero
    :type="$type"
    :size="$size"
    :background-image="$backgroundImage"
    class="predict-hero-section"
>
    <x-slot name="content">
        {{-- Hero Content --}}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    {{-- Main Title with Bootstrap Italia styling --}}
                    <h1 class="display-4 fw-bold text-primary mb-4">
                        {{ $title }}
                        <span class="text-secondary d-block fs-2 mt-2">
                            {{ $subtitle }}
                        </span>
                    </h1>

                    {{-- Description --}}
                    <p class="lead mb-4 text-muted">
                        Leveraging advanced machine learning algorithms and real-time data processing 
                        to provide accurate predictions and actionable insights for your business decisions.
                    </p>

                    {{-- CTA Buttons --}}
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center mb-5">
                        <a href="{{ $ctaUrl }}" class="btn btn-primary btn-lg px-4 py-2">
                            <svg class="icon icon-sm me-2">
                                <use href="#it-chart-line"></use>
                            </svg>
                            {{ $ctaText }}
                        </a>
                        <a href="#features" class="btn btn-outline-primary btn-lg px-4 py-2">
                            <svg class="icon icon-sm me-2">
                                <use href="#it-info-circle"></use>
                            </svg>
                            Learn More
                        </a>
                    </div>

                    {{-- Progress Indicator for Demo --}}
                    <div class="mb-4">
                        <x-bootstrap-italia.progress-indicators 
                            type="bar" 
                            :percentage="75" 
                            color="primary"
                            label="Model Training Progress"
                            show-percentage="true"
                        />
                    </div>
                </div>
            </div>

            {{-- Stats Section --}}
            @if($showStats)
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card border-0 bg-white shadow-sm">
                        <div class="card-body p-4">
                            <div class="row text-center">
                                @foreach($displayStats as $stat)
                                <div class="col-6 col-md-3 mb-3 mb-md-0">
                                    <div class="d-flex flex-column align-items-center">
                                        {{-- Icon --}}
                                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 mb-3">
                                            <svg class="icon icon-lg text-primary">
                                                <use href="#it-{{ $stat['icon'] }}"></use>
                                            </svg>
                                        </div>
                                        
                                        {{-- Value --}}
                                        <div class="display-6 fw-bold text-primary mb-1">
                                            {{ $stat['value'] }}
                                        </div>
                                        
                                        {{-- Label --}}
                                        <div class="fw-semibold text-dark mb-1">
                                            {{ $stat['label'] }}
                                        </div>
                                        
                                        {{-- Description --}}
                                        <div class="small text-muted text-center">
                                            {{ $stat['description'] }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Feature Highlight Cards --}}
            <div class="row mt-5" id="features">
                <div class="col-12">
                    <h2 class="text-center mb-4 text-dark">Key Features</h2>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                                <svg class="icon icon-lg text-success">
                                    <use href="#it-chart-line"></use>
                                </svg>
                            </div>
                            <h5 class="card-title text-dark">Real-time Analytics</h5>
                            <p class="card-text text-muted">
                                Process and analyze data streams in real-time with sub-second latency 
                                for immediate insights and rapid decision-making.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                                <svg class="icon icon-lg text-warning">
                                    <use href="#it-settings"></use>
                                </svg>
                            </div>
                            <h5 class="card-title text-dark">ML Model Management</h5>
                            <p class="card-text text-muted">
                                Deploy, monitor, and optimize machine learning models with automated 
                                versioning, A/B testing, and performance tracking.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                                <svg class="icon icon-lg text-info">
                                    <use href="#it-lock"></use>
                                </svg>
                            </div>
                            <h5 class="card-title text-dark">Secure & Compliant</h5>
                            <p class="card-text text-muted">
                                Enterprise-grade security with end-to-end encryption, audit trails, 
                                and compliance with GDPR and industry standards.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Notification Example --}}
            <div class="row mt-4">
                <div class="col-12">
                    <x-bootstrap-italia.notifiche 
                        type="success"
                        title="System Status"
                        message="All prediction models are running optimally. Last update: {{ now()->format('H:i') }}"
                        :dismissible="false"
                        :auto-hide="false"
                        icon="check-circle"
                    />
                </div>
            </div>
        </div>
    </x-slot>
</x-bootstrap-italia.hero>

{{-- Additional JavaScript for enhanced interactions --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate stats counters
    const statValues = document.querySelectorAll('.predict-hero-section .display-6');
    
    statValues.forEach(stat => {
        const finalValue = stat.textContent;
        const isNumeric = /^\d+/.test(finalValue);
        
        if (isNumeric) {
            const numericPart = parseInt(finalValue.match(/\d+/)[0]);
            let current = 0;
            const increment = numericPart / 50;
            const suffix = finalValue.replace(/^\d+/, '');
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= numericPart) {
                    stat.textContent = numericPart + suffix;
                    clearInterval(timer);
                } else {
                    stat.textContent = Math.floor(current) + suffix;
                }
            }, 50);
        }
    });
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endpush

{{-- Custom CSS for enhanced styling --}}
@push('styles')
<style>
.predict-hero-section {
    background: linear-gradient(135deg, #f8f9ff 0%, #e8f4ff 100%);
    position: relative;
    overflow: hidden;
}

.predict-hero-section::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%230066cc' fill-opacity='0.03'%3E%3Cpath d='m30 0h-30v30h30z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.5;
    z-index: 0;
}

.predict-hero-section .container {
    position: relative;
    z-index: 1;
}

.predict-hero-section .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.predict-hero-section .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
}

.predict-hero-section .btn {
    transition: all 0.3s ease;
}

.predict-hero-section .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 102, 204, 0.3);
}

@media (max-width: 768px) {
    .predict-hero-section .display-4 {
        font-size: 2rem;
    }
    
    .predict-hero-section .display-6 {
        font-size: 1.5rem;
    }
}
</style>
@endpush
