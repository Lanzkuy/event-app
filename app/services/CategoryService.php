<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategory(): array
    {
        return $this->categoryRepository->getAll();
    }

    public function getCategory(int $id): array
    {
        return $this->categoryRepository->get($id);
    }
}
