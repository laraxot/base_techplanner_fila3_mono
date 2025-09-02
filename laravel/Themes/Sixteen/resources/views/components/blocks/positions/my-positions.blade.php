{{--
Bootstrap Italia Positions Component for Predict Module
Enhanced positions display with Bootstrap Italia compliance
--}}

@props([
    'positions' => [],
    'showFilters' => true,
    'showStats' => true,
    'allowActions' => true
])

@php
    // Sample positions data if none provided
    $defaultPositions = [
        [
            'id' => 1,
            'name' => 'Senior Data Scientist',
            'department' => 'Analytics',
            'status' => 'active',
            'prediction_confidence' => 92,
            'risk_level' => 'low',
            'last_updated' => now()->subHours(2),
            'metrics' => [
                'accuracy' => 94,
                'efficiency' => 87,
                'performance' => 91
            ]
        ],
        [
            'id' => 2,
            'name' => 'ML Engineering Lead',
            'department' => 'Engineering',
            'status' => 'review',
            'prediction_confidence' => 78,
            'risk_level' => 'medium',
            'last_updated' => now()->subHours(1),
            'metrics' => [
                'accuracy' => 82,
                'efficiency' => 74,
                'performance' => 85
            ]
        ],
        [
            'id' => 3,
            'name' => 'AI Research Specialist',
            'department' => 'Research',
            'status' => 'pending',
            'prediction_confidence' => 65,
            'risk_level' => 'high',
            'last_updated' => now()->subMinutes(30),
            'metrics' => [
                'accuracy' => 71,
                'efficiency' => 68,
                'performance' => 73
            ]
        ]
    ];
    
    $displayPositions = !empty($positions) ? $positions : $defaultPositions;
@endphp

<div class="my-positions-section">
    {{-- Section Header --}}
    <div class="container mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-1">
                    <svg class="icon icon-lg me-2 text-primary">
                        <use href="#it-user-circle"></use>
                    </svg>
                    Current Positions
                </h2>
                <p class="text-muted mb-0">Real-time analysis of position performance and predictions</p>
            </div>
            <div class="col-auto">
                @if($allowActions)
                <div class="btn-group">
                    <button class="btn btn-outline-primary btn-sm">
                        <svg class="icon icon-xs me-1">
                            <use href="#it-plus"></use>
                        </svg>
                        Add Position
                    </button>
                    <button class="btn btn-outline-secondary btn-sm">
                        <svg class="icon icon-xs me-1">
                            <use href="#it-download"></use>
                        </svg>
                        Export
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Filters and Controls --}}
    @if($showFilters)
    <div class="container mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <x-bootstrap-italia.select 
                            name="department_filter"
                            :options="[
                                '' => 'All Departments',
                                'analytics' => 'Analytics',
                                'engineering' => 'Engineering',
                                'research' => 'Research'
                            ]"
                            label="Department"
                        />
                    </div>
                    <div class="col-md-3">
                        <x-bootstrap-italia.select 
                            name="status_filter"
                            :options="[
                                '' => 'All Status',
                                'active' => 'Active',
                                'review' => 'Under Review',
                                'pending' => 'Pending'
                            ]"
                            label="Status"
                        />
                    </div>
                    <div class="col-md-3">
                        <x-bootstrap-italia.select 
                            name="risk_filter"
                            :options="[
                                '' => 'All Risk Levels',
                                'low' => 'Low Risk',
                                'medium' => 'Medium Risk',
                                'high' => 'High Risk'
                            ]"
                            label="Risk Level"
                        />
                    </div>
                    <div class="col-md-3">
                        <div class="d-grid">
                            <button class="btn btn-primary">
                                <svg class="icon icon-xs me-1">
                                    <use href="#it-search"></use>
                                </svg>
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Summary Statistics --}}
    @if($showStats)
    <div class="container mb-4">
        <div class="row">
            <div class="col-md-3 col-6 mb-3">
                <div class="card border-0 bg-success bg-opacity-10">
                    <div class="card-body text-center">
                        <div class="display-6 fw-bold text-success">{{ count(array_filter($displayPositions, fn($p) => $p['status'] === 'active')) }}</div>
                        <div class="small text-muted">Active Positions</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="card border-0 bg-warning bg-opacity-10">
                    <div class="card-body text-center">
                        <div class="display-6 fw-bold text-warning">{{ count(array_filter($displayPositions, fn($p) => $p['status'] === 'review')) }}</div>
                        <div class="small text-muted">Under Review</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="card border-0 bg-info bg-opacity-10">
                    <div class="card-body text-center">
                        <div class="display-6 fw-bold text-info">{{ count(array_filter($displayPositions, fn($p) => $p['status'] === 'pending')) }}</div>
                        <div class="small text-muted">Pending</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="card border-0 bg-primary bg-opacity-10">
                    <div class="card-body text-center">
                        <div class="display-6 fw-bold text-primary">{{ round(collect($displayPositions)->avg('prediction_confidence')) }}%</div>
                        <div class="small text-muted">Avg Confidence</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Positions List --}}
    <div class="container">
        <div class="row">
            @foreach($displayPositions as $position)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 position-card" data-position-id="{{ $position['id'] }}">
                    {{-- Card Header --}}
                    <div class="card-header bg-white border-0 pb-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="mb-1 fw-semibold">{{ $position['name'] }}</h5>
                                <div class="small text-muted">{{ $position['department'] }}</div>
                            </div>
                            <div class="col-auto">
                                {{-- Status Badge --}}
                                @php
                                    $statusColors = [
                                        'active' => 'success',
                                        'review' => 'warning',
                                        'pending' => 'secondary'
                                    ];
                                    $statusColor = $statusColors[$position['status']] ?? 'secondary';
                                @endphp
                                <x-bootstrap-italia.badge :color="$statusColor" size="sm">
                                    {{ ucfirst($position['status']) }}
                                </x-bootstrap-italia.badge>
                            </div>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body">
                        {{-- Prediction Confidence --}}
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="small fw-semibold">Prediction Confidence</span>
                                <span class="small text-muted">{{ $position['prediction_confidence'] }}%</span>
                            </div>
                            <x-bootstrap-italia.progress-indicators 
                                type="bar" 
                                :percentage="$position['prediction_confidence']"
                                :color="$position['prediction_confidence'] >= 80 ? 'success' : ($position['prediction_confidence'] >= 60 ? 'warning' : 'danger')"
                                size="sm"
                            />
                        </div>

                        {{-- Risk Level --}}
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small fw-semibold">Risk Level</span>
                                @php
                                    $riskColors = [
                                        'low' => 'success',
                                        'medium' => 'warning',
                                        'high' => 'danger'
                                    ];
                                    $riskColor = $riskColors[$position['risk_level']] ?? 'secondary';
                                @endphp
                                <x-bootstrap-italia.badge :color="$riskColor" size="xs">
                                    {{ ucfirst($position['risk_level']) }}
                                </x-bootstrap-italia.badge>
                            </div>
                        </div>

                        {{-- Performance Metrics --}}
                        <div class="mb-3">
                            <h6 class="fw-semibold mb-2">Performance Metrics</h6>
                            <div class="row g-2">
                                <div class="col-4">
                                    <div class="text-center p-2 bg-light rounded">
                                        <div class="fw-bold text-primary small">{{ $position['metrics']['accuracy'] }}%</div>
                                        <div class="small text-muted" style="font-size: 0.7rem;">Accuracy</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-center p-2 bg-light rounded">
                                        <div class="fw-bold text-success small">{{ $position['metrics']['efficiency'] }}%</div>
                                        <div class="small text-muted" style="font-size: 0.7rem;">Efficiency</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-center p-2 bg-light rounded">
                                        <div class="fw-bold text-info small">{{ $position['metrics']['performance'] }}%</div>
                                        <div class="small text-muted" style="font-size: 0.7rem;">Performance</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Last Updated --}}
                        <div class="small text-muted mb-3">
                            <svg class="icon icon-xs me-1">
                                <use href="#it-clock"></use>
                            </svg>
                            Updated {{ $position['last_updated']->diffForHumans() }}
                        </div>
                    </div>

                    {{-- Card Actions --}}
                    @if($allowActions)
                    <div class="card-footer bg-light border-0">
                        <div class="row g-2">
                            <div class="col-6">
                                <button class="btn btn-outline-primary btn-sm w-100">
                                    <svg class="icon icon-xs me-1">
                                        <use href="#it-eye"></use>
                                    </svg>
                                    View Details
                                </button>
                            </div>
                            <div class="col-6">
                                <div class="dropdown w-100">
                                    <button class="btn btn-outline-secondary btn-sm w-100 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><svg class="icon icon-xs me-2"><use href="#it-edit"></use></svg>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><svg class="icon icon-xs me-2"><use href="#it-copy"></use></svg>Duplicate</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#"><svg class="icon icon-xs me-2"><use href="#it-delete"></use></svg>Remove</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Live Updates Notification --}}
    <div class="container mt-4">
        <x-bootstrap-italia.notifiche 
            type="info"
            title="Live Updates"
            message="Position data is automatically updated every 5 minutes. Next update in 3:42"
            :dismissible="false"
            position="static"
            size="sm"
            icon="refresh"
        />
    </div>
</div>

{{-- Enhanced JavaScript for interactions --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Position card interactions
    document.querySelectorAll('.position-card').forEach(card => {
        const positionId = card.dataset.positionId;
        
        // Hover effects
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 10px 25px rgba(0, 0, 0, 0.15)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '';
        });
        
        // View details button
        const viewBtn = card.querySelector('button[class*="btn-outline-primary"]');
        if (viewBtn) {
            viewBtn.addEventListener('click', function(e) {
                e.preventDefault();
                console.log(`Viewing details for position ${positionId}`);
                
                // Show detailed view (placeholder)
                window.createNotification && window.createNotification(
                    `Loading details for position ${positionId}...`,
                    'info',
                    {
                        title: 'Loading Details',
                        autoHide: 2000,
                        position: 'right-fix',
                        icon: 'loading'
                    }
                );
            });
        }
    });
    
    // Filter functionality
    document.querySelectorAll('select[name$="_filter"]').forEach(select => {
        select.addEventListener('change', function() {
            console.log(`Filter changed: ${this.name} = ${this.value}`);
            // In real implementation, this would trigger filtering
        });
    });
    
    // Apply filters button
    const applyFiltersBtn = document.querySelector('button[class*="btn-primary"]:has(.icon)');
    if (applyFiltersBtn && applyFiltersBtn.textContent.includes('Apply')) {
        applyFiltersBtn.addEventListener('click', function() {
            // Show loading state
            const originalText = this.innerHTML;
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Applying...';
            this.disabled = true;
            
            // Simulate filtering
            setTimeout(() => {
                this.innerHTML = originalText;
                this.disabled = false;
                
                // Show result notification
                window.createNotification && window.createNotification(
                    'Filters applied successfully',
                    'success',
                    {
                        title: 'Filters Updated',
                        autoHide: 3000,
                        position: 'right-fix',
                        icon: 'check'
                    }
                );
            }, 1500);
        });
    }
    
    // Auto-refresh positions data
    setInterval(function() {
        // In real implementation, this would refresh the data
        console.log('Auto-refreshing positions data...');
    }, 300000); // Every 5 minutes
});
</script>
@endpush

{{-- Custom styles --}}
@push('styles')
<style>
.my-positions-section .position-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.my-positions-section .position-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
}

.my-positions-section .card-header {
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.my-positions-section .btn-outline-primary:hover,
.my-positions-section .btn-outline-secondary:hover {
    transform: translateY(-1px);
}

.my-positions-section .dropdown-menu {
    font-size: 0.9rem;
}

.my-positions-section .display-6 {
    font-size: 1.5rem;
    line-height: 1.2;
}

@media (max-width: 768px) {
    .my-positions-section .display-6 {
        font-size: 1.25rem;
    }
    
    .my-positions-section .position-card {
        margin-bottom: 1rem;
    }
}
</style>
@endpush
