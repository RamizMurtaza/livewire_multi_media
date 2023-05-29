<div>

    <form wire:submit.prevent="uploadFiles" enctype="multipart/form-data">

        <input type="file" wire:model="images" multiple accept="image/*" >

        <div wire:loading wire:target="images">Uploading the images...</div>

        @if( !empty( $images ) )

            <div class="row">
                <div class="col-md-12">
                    <p class="text-left"> Preview your images before uploading </p>
                </div>
                @foreach ( $images as $image )
                    <div class="media-list media-bordered col-md-3">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img src="{{$image->temporaryUrl()}}" alt="Generic placeholder image" style="width: 64px;height: 64px;">
                            </a>
                            <div class="media-body">
                                <h5 class="media-heading">{{$image->getClientOriginalName()}} </h5>
                                <h10>{{\App\Helpers\Helper::getFileSize($image->getSize())}}
                                    @error('images.'.$loop->index)
                                    <span class="danger">{{ $message }}</span>
                                    @enderror
                                </h10>
                                <p wire:key="{{$loop->index}}" wire:click="removeImage({{$loop->index}})" class="danger">Remove</p>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

            <button type="submit" >Upload Images</button>

        @endif

    </form>

{{--    @if(!empty($uploadImages))--}}
{{--        <p>uploaded images</p>--}}

        <div class="row">

            @foreach($media as $uploadImage)

                <div class="col-md-2">
                    <div class="card text-center">
                        <div class="card-content">
                            <img style="width: 500px; height: 200px; border: 1px solid red" class="card-img-top img-fluid" src="{{$uploadImage->link}}" alt="Card image cap">
                            <div class="card-body">
                                <h8 class="card-title">Running Shoes</h8>
                                <p class="danger" wire:click="deleteImage(11)">Remove from uploads</p>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

                <div class="text-right" style="float: right">
                    {{ $media->links('livewire.livewire-pagination') }}
                </div>
        </div>
{{--    @endif--}}

</div>
