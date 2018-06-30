<?php
require 'databaseoperetor.php';
class ChatBot extends DataBaseOperetor
{
    protected $chat_history;
    private const BOT_NAME = "Bot: ";
    private const USER_NAME = "You: ";
    private const FIRST_MESSAGE = "Hello, how can i help you?";
    private const DEFULT_RESPONSE = "Sorry, I dont know the answer for this question.";

    public function __construct($host = "localhost", $username = "root", $password = "", $databasename = "mybot")
    {
        //connecting to mysqli (new mysqli - default: $host = "localhost", $username = "root", $password = "", $databasename = "mybot"),creating new database and tables if needed.
        parent::__construct($host, $username, $password, $databasename);

        //Defines first sentence for bot on firstload .
        if (!$this->chat_history = $this->select('history', 'rows')) {
            $this->insert('history', 'rows', self::BOT_NAME . self::FIRST_MESSAGE);
            $this->chat_history = $this->select('history', 'rows');
        }

        //buttons controller.
        if (!empty($_POST)) {
            switch (true) {
                case isset($_POST['send']):
                    $this->newQuestion($_POST['question']);
                    break;
                case isset($_POST['clearhistory']):
                    $this->clearHistory();
                    break;
                case isset($_POST['edit']):
                    $this->editAnswer($_POST['id'], $_POST['answer']);
                    break;
                case isset($_POST['remove']):
                    $this->removeLine($_POST['removeId']);
                    break;
            }
        }
    }

    public function newQuestion($question)
    {
        $this->insert('history', 'rows', self::USER_NAME . $question);
        if ($answer = $this->select('qa', 'answer', "question = '$question'")) {
            $this->insert('history', 'rows', self::BOT_NAME . $answer[0]['answer']);
        } else {
            $this->insert('history', 'rows', self::BOT_NAME . self::DEFULT_RESPONSE);
            $this->insert('qa', 'question', $question);
        }
        $this->chat_history = $this->select('history', 'rows');
    }

    public function clearHistory()
    {
        $this->truncate('history');
        $this->insert('history', 'rows', self::BOT_NAME . self::FIRST_MESSAGE);
        $this->chat_history = $this->select('history', 'rows');
    }

    public function editAnswer($question_id, $answer)
    {
        $this->update('qa', 'answer', $answer, "id = '$question_id'");
    }

    public function removeLine($remove_id)
    {
        $this->delete('qa', "id = '$remove_id'");
    }

    public function printChat()
    {
        return include "chatbot_container.php";
    }
    public function printQaTable()
    {
        return include "qa_table.php";
    }
}
