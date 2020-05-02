<div class="card">
        <div class="card-header" id="view-experience-details">
            <div class="row justify-content-center">
                <div class="col-md-6 offset-md-3">
                    <h5 class="mb-0">
                        <button class="btn btn-info collapsed" data-toggle="collapse" data-target="#view-experience" aria-expanded="false" aria-controls="view-experience">
                        Manage Experience Information
                        </button>
                    </h5>
                </div>
            </div>
        </div>
        <div id="view-experience" class="collapse" aria-labelledby="view-experience" data-parent="#accordion">
            <div class="card-body shadow-lg border border-dark">
                <a href="{{ route('applicant.experience-edit', [$applicantInfo->applicant_id, ]) }}"></a>
            </div>
        </div>
    </div>
