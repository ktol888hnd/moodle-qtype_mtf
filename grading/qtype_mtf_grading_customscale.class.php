<?php
defined('MOODLE_INTERNAL') || die();

require_once(
    $CFG->dirroot .
    '/question/type/mtf/grading/qtype_mtf_grading.class.php'
);

class qtype_mtf_grading_customscale extends qtype_mtf_grading {

    /** @var string */
    const TYPE = 'customscale';

    public function get_name() {
        return self::TYPE;
    }

    public function get_title() {
        return get_string(
            'scoringcustomscale',
            'qtype_mtf'
        );
    }

    public function grade_question($question, $answers) {

        $correctrows = 0;

        foreach ($question->order as $key => $rowid) {

            $row = $question->rows[$rowid];

            $grade = $this->grade_row(
                $question,
                $key,
                $row,
                $answers
            );

            if ($grade > 0) {
                ++$correctrows;
            }
        }

        $totalrows = count($question->rows);

        if ($totalrows === 4) {

            $scale = [
                0 => 0.00,
                1 => 0.10,
                2 => 0.25,
                3 => 0.50,
                4 => 1.00,
            ];

            return $scale[$correctrows];
        }

        return 1.0 * $correctrows / $totalrows;
    }
}

