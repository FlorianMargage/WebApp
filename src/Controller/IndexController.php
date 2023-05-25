<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\DBAL\Connection;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    
    public function index(): Response
    {
        $sql = "SELECT * FROM animes";
        $anime = $this->connection->executeQuery($sql)->fetchAllAssociative();
        $episode = $this->connection->executeQuery("SELECT * FROM episodes")->fetchAllAssociative();

        return $this->render('anime_view.html.twig', [
            'anime' => $anime,
            'episode' => $episode,
        ]);
    }

    public function animes()
    {
        $animes = $this->connection->executeQuery("SELECT * FROM animes")->fetchAllAssociative();
        return $this->render('index.html.twig', [
            'animes' => $animes,
        ]);
    }

    public function seasons($id_anime) 
    {
        $seasons = $this->connection->executeQuery("SELECT * FROM seasons WHERE id_anime = $id_anime")->fetchAllAssociative();

        return $this->render('season_view.html.twig', [
            'seasons' => $seasons,
        ]);
    }

    public function episodes($id_anime, $num_season) 
    {
        $episodes = $this->connection->executeQuery("SELECT * FROM episodes INNER JOIN seasons ON episodes.id_season=seasons.id WHERE id_anime = $id_anime and num_season = $num_season")->fetchAllAssociative();

        return $this->render('episode_view.html.twig', [
            'episodes' => $episodes,
        ]);
    }

    public function view($id_anime, $num_season, $num_episode)
    {
        $episode = $this->connection->executeQuery("SELECT * FROM episodes INNER JOIN seasons ON episodes.id_season = seasons.id WHERE id_anime = $id_anime and num_season = $num_season and num_episode = $num_episode")->fetchAllAssociative();

        return $this->render('view.html.twig', [
            'episode' => $episode[0],
        ]);
    }

}
