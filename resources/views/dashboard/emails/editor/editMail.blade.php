@extends('dashboard.layouts.dash')
   @section('edit-emails')
   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <div class="d-flex justify-content-center">
            <h5 class="m-0 font-weight-bold text-primary">
               Blasting Email
            </h5>
         </div>
         <div class="card-body">
            <div class="col-lg-12">
               <div class="row">
                  <div class="col-lg-6">
                     <div class="card shadow py-3">
                        <div class="card-header" id="editor-Header">
                           <label for="editor-Header">Editor</label>
                        </div>
                        <div class="card-body">
                           <div>
                              <h5>Subject</h5>
                              <textarea name="subject" id="subject" cols="30" rows="10" class="my-3"></textarea>
                              <script>
                                 ClassicEditor
                                    .create(document.querySelector( '#subject'))
                                    .catch(error=> { 
                                          console.error(error);
                                    });
                              </script>
                           </div>
                           <div class="mt-5">
                              <H5>Message</H5>
                              <textarea name="object" id="object" cols="30" rows="10" class="my-3"></textarea>
                              <script>
                                 ClassicEditor
                                    .create(document.querySelector( '#object'))
                                    .catch(error=> { 
                                          console.error(error);
                                    });
                              </script>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="card shadow py-3">
                        <div class="card-header" id="preview-Header">
                           <label for="preview-Header">Preview</label>
                        </div>
                        <div class="card-body">
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   
   @endsection
   