<?php
// This file is part of Moodle - http://moodle.org/.

namespace qtype_mtf;

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

require_once(
    $CFG->dirroot .
    '/question/engine/tests/helpers.php'
);

/**
 * Unit tests for customscale grading.
 *
 * @package     qtype_mtf
 * @group       qtype_mtf
 */
final class qtype_mtf_grading_customscale_test extends \advanced_testcase {

    /**
     * Create a simple 4-row MTF question.
     *
     * @return \qtype_mtf_question
     */
    protected function get_question(): \qtype_mtf_question {

        \question_bank::load_question_definition_classes('mtf');

        $q = new \qtype_mtf_question();

        $q->numberofrows = 4;
        $q->numberofcolumns = 2;
        $q->order = [1, 2, 3, 4];

        $q->rows = [
            1 => (object)['number' => 1],
            2 => (object)['number' => 2],
            3 => (object)['number' => 3],
            4 => (object)['number' => 4],
        ];

        $q->weights = [
            1 => [
                1 => (object)['weight' => 1.0],
                2 => (object)['weight' => 0.0],
            ],
            2 => [
                1 => (object)['weight' => 1.0],
                2 => (object)['weight' => 0.0],
            ],
            3 => [
                1 => (object)['weight' => 1.0],
                2 => (object)['weight' => 0.0],
            ],
            4 => [
                1 => (object)['weight' => 1.0],
                2 => (object)['weight' => 0.0],
            ],
        ];

        return $q;
    }

    /**
     * @covers ::grade_question
     */
    public function test_customscale_0_correct(): void {

        $grading = new \qtype_mtf_grading_customscale();

        $grade = $grading->grade_question(
            $this->get_question(),
            [
                'option0' => 2,
                'option1' => 2,
                'option2' => 2,
                'option3' => 2,
            ]
        );

        $this->assertEquals(0.0, $grade);
    }

    /**
     * @covers ::grade_question
     */
    public function test_customscale_1_correct(): void {

        $grading = new \qtype_mtf_grading_customscale();

        $grade = $grading->grade_question(
            $this->get_question(),
            [
                'option0' => 1,
                'option1' => 2,
                'option2' => 2,
                'option3' => 2,
            ]
        );

        $this->assertEquals(0.10, $grade);
    }

    /**
     * @covers ::grade_question
     */
    public function test_customscale_2_correct(): void {

        $grading = new \qtype_mtf_grading_customscale();

        $grade = $grading->grade_question(
            $this->get_question(),
            [
                'option0' => 1,
                'option1' => 1,
                'option2' => 2,
                'option3' => 2,
            ]
        );

        $this->assertEquals(0.25, $grade);
    }

    /**
     * @covers ::grade_question
     */
    public function test_customscale_3_correct(): void {

        $grading = new \qtype_mtf_grading_customscale();

        $grade = $grading->grade_question(
            $this->get_question(),
            [
                'option0' => 1,
                'option1' => 1,
                'option2' => 1,
                'option3' => 2,
            ]
        );

        $this->assertEquals(0.50, $grade);
    }

    /**
     * @covers ::grade_question
     */
    public function test_customscale_4_correct(): void {

        $grading = new \qtype_mtf_grading_customscale();

        $grade = $grading->grade_question(
            $this->get_question(),
            [
                'option0' => 1,
                'option1' => 1,
                'option2' => 1,
                'option3' => 1,
            ]
        );

        $this->assertEquals(1.0, $grade);
    }
}
