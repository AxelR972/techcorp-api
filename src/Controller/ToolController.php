<?php

namespace App\Controller;

use App\Repository\ToolRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ToolController extends AbstractController
{
    #[Route('/api/tools', name: 'api_tools', methods: ['GET'])]
    public function list(ToolRepository $repo, Request $request): JsonResponse
    {
        $tools = $repo->findAll();

        return $this->json([
            'data' => $tools,
            'total' => count($tools),
        ]);
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
