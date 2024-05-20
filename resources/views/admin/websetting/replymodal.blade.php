{{-- Modal subcategory add --}}
<style>
    .input-group-text {
        border: none;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="messageReply" tabindex="-1" aria-labelledby="messageReplyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="messageReplyLabel">Reply to Customer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{-- <div class="category_form" id="category_form"></div> --}}
        <form id="userUpdateFrom">
            @csrf
            <input type="hidden" name="message_id" id="message_id">
            <div class="modal-body">
                <div class="row gx-3">

                    <div class="col-lg-12 col-md-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">To</span>
                            <input type="text" class="form-control" placeholder="User Email" aria-label="User Email" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Subject</span>
                            <input type="text" class="form-control" placeholder="Subject" aria-label="Subject" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <label for="summernote" class="form-label"> Your Message</label>
                        <textarea name="replymessage" id="summernote" class="form-control" cols="30" rows="10" placeholder="Write your message here..."></textarea>
                    </div>

                </div>
            </div>
        </form>
      </div>
    </div>
</div>


