{{-- <div class="row p-4"> --}}
    <form action="{{route('reach-out')}}" method="POST">
        @csrf
        <input type="hidden" value="{{$applicant->applicant_id}}" name="applicant_id">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="your organization or your name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" class="form-control" placeholder="subject of your message">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="your organization or your email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Message</label>
                    <textarea name="message" id="" cols="30" rows="10" class="form-control" placeholder="message for this applicant"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="form-group">
                    <input type="submit" value="Reach Out" class="form-control btn-secondary">
                </div>
            </div>
        </div>
    </form>
{{-- </div> --}}
