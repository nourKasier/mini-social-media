<?php

namespace Domain\Posts\DataTransferObjects;

//use App\Http\Requests\Post\StorePostRequest;

use Application\Posts\Requests\StorePostRequest;
use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

class PostData extends DataTransferObject
{
    public function __construct(
        public string $title,
        public string $content,
        public UploadedFile $picture,
        ) {}

    //$data = new CustomerData(...$customerRequest->validated());

    // public string $title;

    // public string $content;

    // public string $picture;

    // public static function fromStoreRequest(StorePostRequest $request): PostData
    // {
    //     $dto = new self();

    //     $dto->title = $request->input('title');
    //     $dto->content = $request->input('content');
    //     $dto->picture = $request->input('picture');

    //     return $dto;
    // }

    //$data = CustomerData::fromRequest($customerRequest);



//     public static function fromRequest(StorePostRequest $request): self
//     {
//         return new self([
//         'title' => $request->get('title'),
//         'content' => $request->get('content'),
//         'picture' => $request->get('picture'),
//         ]);
//     }

// //$data = CustomerData::fromRequest($customerRequest);

}
