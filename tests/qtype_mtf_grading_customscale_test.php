<?php
// This file is part of Moodle - http://moodle.org/.

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once(
    $CFG->dirroot .
    '/question/type/mtf/grading/qtype_mtf_grading_customscale.class.php'
);

require_once(
    $CFG->dirroot .
    '/question/type/mtf/question.php'
);

/**
 * PHPUnit tests for customscale grading.
 *
 * @package     qtype_mtf
 * @covers      qtype_mtf_grading_customscale
 */
final class qtype_mtf_grading_customscale_test extends advanced_testcase {

    /**
     * Build test question.
     *
     * @return qtype_mtf_question
     */
    protected function create_question(): qtype_mtf_question {

        $question = new qtype_mtf_question();

        $question->numberofrows = 4;
        $question->order = [1, 2, 3, 4];

        $question->rows = [
            1 => (object)['number' => 1],
            2 => (object)['number' => 2],
            3 => (object)['number' => 3],
            4 => (object)['number' => 4],
        ];

        $question->weights = [
            1 => [1 => (object)['weight' => 1]],
            2 => [1 => (object)['weight' => 1]],
            3 => [1 => (object)['weight' => 1]],
            4 => [1 => (object)['weight' => 1]],
        ];

        return $question;
    }

    /**
     * 0 correct.
     */
    public function test_zero_correct(): void {

        $question = $this->create_question();
        $grading = new qtype_mtf_grading_customscale();

        $answers = [
            'option0' => 2,
            'option1' => 2,
            'option2' => 2,
            'option3' => 2,
        ];

        $this->assertEquals(
            0.0,
            $grading->grade_question($question, $answers)
        );
    }

    /**
     * 1 correct.
     */
    public function test_one_correct(): void {

        $question = $this->create_question();
        $grading = new qtype_mtf_grading_customscale();

        $answers = [
            'option0' => 1,
            'option1' => 2,
            'option2' => 2,
            'option3' => 2,
        ];

        $this->assertEquals(
            0.10,
            $grading->grade_question($question, $answers)
        );
    }

    /**
     * 2 correct.
     */
    public function test_two_correct(): void {

        $question = $this->create_question();
        $grading = new qtype_mtf_grading_customscale();

        $answers = [
            'option0' => 1,
            'option1' => 1,
            'option2' => 2,
            'option3' => 2,
        ];

        $this->assertEquals(
            0.25,
            $grading->grade_question($question, $answers)
        );
    }

    /**
     * 3 correct.
     */
    public function test_three_correct(): void {

        $question = $this->create_question();
        $grading = new qtype_mtf_grading_customscale();

        $answers = [
            'option0' => 1,
            'option1' => 1,
            'option2' => 1,
            'option3' => 2,
        ];

        $this->assertEquals(
            0.50,
            $grading->grade_question($question, $answers)
        );
    }

    /**
     * 4 correct.
     */
    public function test_four_correct(): void {

        $question = $this->create_question();
        $grading = new qtype_mtf_grading_customscale();

        $answers = [
            'option0' => 1,
            'option1' => 1,
            'option2' => 1,
            'option3' => 1,
        ];

        $this->assertEquals(
            1.0,
            $grading->grade_question($question, $answers)
        );
    }
}
