<?php namespace Survey\Commands;

use Survey\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Survey\Result;

class ColltectResults extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

    protected $result;

    /**
     * Create a new command instance.
     *
     * @param Result $result
     */
	public function __construct(Result $result)
	{
		$this->result = $result;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
        $result = $this->result;
        $all_answers = $result['answers'];
        $questions = $result['questions'];
        $i=0;
        foreach($questions as $section)
        {
            $data[$i]['name'] = $section['title'];
            $q = 0;

            foreach ($section['questiongroups'] as $questiongroup)
            {
                $data[$i]['questiongroups'][$q]['name'] = $questiongroup['heading'];
                $data[$i]['questiongroups'][$q]['type'] = $questiongroup['type'];
                $data[$i]['questiongroups'][$q]['condition'] = $questiongroup['condition'];
                switch($questiongroup['type'])
                {
                    case 3:
                        $a = 0;
                        foreach ($questiongroup['questions'] as $question) {
                            $answers = $all_answers[$question['id']];
                            $part = 0;
                            $sol = array(0, 0, 0, 0, 0, 0);
                            foreach ($answers as $answer) {
                                $part++;
                                $sol[$answer['answer']]++;
                            }
                            foreach ($sol as $key => $so) {
                                $votes[$key]['absolut'] = $so;
                                $votes[$key]['percent'] = ($so / $part) * 100;
                                $votes[$key]['vote'] = $key;
                            }
                            $data[$i]['questiongroups'][$q]['answers'][$a]['participants'] = $part;
                            $data[$i]['questiongroups'][$q]['answers'][$a]['name'] = $question['content'];
                            $data[$i]['questiongroups'][$q]['answers'][$a]['votes'] = $votes;
                            $a++;
                        }
                        break;
                }
                $q++;
            }
            $i++;
        }
        $result->data = $data;
        $result->save();
	}

}
