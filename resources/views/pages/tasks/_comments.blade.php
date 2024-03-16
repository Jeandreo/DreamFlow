@if ($contents->count())
   @php $previousCreatedBy = null @endphp
   @foreach ($contents as $content)
      @if ($content->created_by != $previousCreatedBy)
         <!--begin::User-->
         <div class="d-flex align-items-center mb-2">
               <!--begin::Avatar-->
               <div class="symbol symbol-35px symbol-rounded">
                  <img alt="Pic" src="{{ findImage('users/' . $content->created_by . '/' . 'perfil-35px.jpg') }}">
               </div>
               <!--end::Avatar-->
               <!--begin::Details-->
               <div class="ms-3">
                  <p class="fs-6 fw-bold text-gray-700 me-1 mb-0">{{ $content->author->name }}</p>
                  <p class="text-muted fs-7 mb-0">{{ $content->created_at->format('d/m/Y') }} ás {{ $content->created_at->format('H:i') }}</p>
               </div>
               <!--end::Details-->
         </div>
         <!--end::User-->
         @php $previousCreatedBy = $content->created_by @endphp
      @endif

      <!--begin::Wrapper-->
      <div class="d-flex justify-content-start mb-3">
         <div class="d-flex flex-column align-items-start">
            <!--begin::Text-->
            <div class="p-5 rounded bg-light-primary text-gray-700 fw-semibold mw-lg-400px text-start comment-ajax" data-kt-element="message-text">
               {!! $content->text !!}
            </div>
            <!--end::Text-->
         </div>
      </div>
      <!--end::Wrapper-->
   @endforeach
@endif
