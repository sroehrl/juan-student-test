<?php

namespace Neoan3\Component\TakeTest;

use Neoan3\Frame\Demo;
use Neoan3\Model\Cloze\ClozeModel;
use Neoan3\Model\Score\ScoreModel;

/**
 * Class TakeTestController
 * @package Neoan3\Component\TakeTest
 *
 * Generated by neoan3-cli for neoan3 v3.*
 */

class TakeTestController extends Demo{
    private $counter = 0;
    function init()
    {

        $this->hook('main','takeTest', [
            'testText' => $this->parseTest(sub(1))['text'],
            'testId' => sub(1)
        ]);
        $this->output();
    }
    private function parseTest($clozeId){
        $this->loadModel(ClozeModel::class);
        $test = ClozeModel::get($clozeId);

        $test['test_text'] = preg_replace_callback('/__/', function ($match){
            $input =  '<input data-answer="answer_' . $this->counter . '" type="text">';
            $this->counter++;
            return $input;
        }, $test['test_text']);
        return [
            'text' => $test['test_text'],
            'answers' => json_decode(stripslashes($test['answer_json']),true)
            ];
    }

    /**
    * GET: api.v1/take-test
    * GET: api.v1/take-test/{id}
    * GET: api.v1/take-test?{query-string}
    * @param string|null $id
    * @param array $params
    * @return array
    */
    function getTakeTest(?string $id = null, array $params = []): array
    {
        // Restrict access to logged in users?
        // $this->Auth->restrict();
        // (or without dependency on Demo-Frame: $this->provider['auth']->restrict())
        if($id){
            // Retrieve a model?
            // return $this->loadModel(\Neoan3\Model\TakeTest\TakeTestModel::class)::get($id);
        }
        return $params;
    }

    /**
     * POST: api.v1/take-test
     * @param $body
     * @return array
     */
    function postTakeTest(array $body): array
    {
        $authObject = $this->Auth->restrict();
        $this->loadModel(ScoreModel::class);
        $test = $this->parseTest($body['id']);
        $score = 0;
        $total = count($test['answers']);
        foreach ($test['answers'] as $index => $answer){
           if(trim($body['answers'][$index]) === $answer){
               $score++;
           }
        }
        $result = $score / $total * 100;
        $insert = [
            'user_id' => $authObject->getUserId(),
            'cloze_id' =>  $body['id'],
            'score' => $result
        ];
        var_dump($insert);
        ScoreModel::create($insert);
        return ['test'=>'taken'];
    }
}
