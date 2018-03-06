<?php
namespace pmill\Chat;

use pmill\Chat\Interfaces\ConnectedClientInterface;
use Ratchet\ConnectionInterface;
use App\models\Posts;

class BasicMultiRoomServer extends AbstractMultiRoomServer
{

    protected function makeUserWelcomeMessage(ConnectedClientInterface $client, $timestamp)
    {
        return vsprintf('Welcome %s!', array($client->getName()));
    }

    protected function makeUserConnectedMessage(ConnectedClientInterface $client, $timestamp)
    {
        return vsprintf('%s has connected', array($client->getName()));
    }

    protected function makeUserDisconnectedMessage(ConnectedClientInterface $client, $timestamp)
    {
        return vsprintf('%s est déconnecté', array($client->getName()));
    }

    protected function makeMessageReceivedMessage(ConnectedClientInterface $from, $message, $timestamp)
    {
        return $message;
    }

    protected function logMessageReceived(ConnectedClientInterface $from, $roomId, $message, $timestamp)
    {
        /** save messages to a database, etc... */

        /*
         * Voici les failles
         *
         *  si je récupère l'id d'une autre personne ?
         *  Si la personne existe ?
         *  si je change l'id du parcours / si l'id du parcours existe ?
         *  si je ne suis pas connecté ?
         *
         *  d'autres idées ?
         */

        // La table comprend id - message - parcours_id - user_id

        $posts = new Posts();
        $posts->message = $message;
        $posts->parcours_id = $roomId;
        $posts->user_id = $from->getId();

        try {
            $posts->save();
        } catch (\Exception $e){
            echo $e->getMessage().PHP_EOL;
        }


    }

    protected function createClient(ConnectionInterface $conn, $name, $id)
    {
        $client = new ConnectedClient;
        $client->setResourceId($conn->resourceId);
        $client->setConnection($conn);
        $client->setName($name);

        // ajout de l'id du client
        $client->setId($id);

        return $client;
    }

}