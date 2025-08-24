<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ToolRepository;

final class ToolController extends AbstractController
{
    #[Route('/api/tools', name: 'api_tools_list', methods: ['GET'])]
    public function list(ToolRepository $repo): JsonResponse
    {
        $tools = $repo->findAll();

        return $this->json($tools);
    }
}

  /* public function get(ToolRepository $repo, int $id): JsonResponse
    {
        $tool = $repo->find($id);

        if (!$tool) {
            return $this->json(['error' => 'Tool not found'], 404);
        }

        return $this->json($tool);
    }
}*/
