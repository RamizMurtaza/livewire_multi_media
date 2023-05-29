<?php

namespace App\Http\Livewire\Media;

use App\Helpers\Helper;
use App\Models\Media\Media;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component{

    use WithFileUploads;
    use WithPagination;
    public $currentPage = 1;

    public $images;  // images array before uploading
    public $linkWith; // if edit then bind image with specific model
    public $uploadImages;  // after upload, images will store in this array
    public $batchNo;
    public $imageId;
    public $uploadedImageIds;
    public $relationalId;

    // over all validation rules
    protected $rules = [
        'images.*' => 'required|image|mimes:jpeg,jpg,png|max:1024'
    ];

    // real time validations
    public function updatedImages(){
        $this->validate([
            'images.*' => 'required|image|mimes:jpeg,jpg,png|max:1024'
        ]);
    }

    public function mount(){

    }

    // remove image before uploading the if you want
    public function removeImage($index){
        array_splice($this->images, $index, 1);
    }

    // upload images and return uploaded images
    public function uploadFiles(){

        $this->validate();

        if (!empty($this->linkWith)){
            $this->batchNo = Helper::randomNumber() . '-' . $this->linkWith;
        }else{
            $this->batchNo = Helper::randomNumber();
        }

        $readyToInsertImages = [];
        foreach( $this->images as $image ){

            $imageName = Helper::randomNumber() . '_'. $this->linkWith . '.' .$image->getClientOriginalExtension();
            $image->storeAs('public/media', $imageName);

            $data['unique_name'] = $imageName;
            $data['link'] =  url('media'.'/'.$imageName);
            $data['base_url'] = url('/');
            $data['extension'] = $image->getClientOriginalExtension();
            $data['size'] = Helper::getFileSize($image->getSize());
            $data['alt_tag'] = $image->getClientOriginalName();
            $data['title'] = $image->getClientOriginalName();
            $data['batch_no'] = $this->batchNo;
            $data['description'] = null;
            $data['created_by'] = null;
            $readyToInsertImages[] =  $data;
        }

        DB::table('media')->insert($readyToInsertImages);
        $this->images = [];

        session()->flash('message', 'Images uploaded successfully.');
        return back()->with('uploadedImageIds', $this->uploadedImageIds);
    }

    // delete image after upload
    public function deleteImage($id){
        dd($id);
    }

    // get media with filters
    public function mediaWithFilters(){

        $media =  Media::query();

//        if (!empty($this->link)){
//            $media = $media->where('link','like',  '%'.$this->name.'%')
//                ->orWhere('unique_name','like',  '%'.$this->name.'%');
//        }

        $media = $media->orderBy('id', 'desc');
        return $media->paginate(5);
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

    // final render method
    public function render(){
        $media = $this->mediaWithFilters();
        $data = ['media' => $media];

        return view('livewire.media.index', $data);
    }
}
