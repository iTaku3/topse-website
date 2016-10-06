<?php
/*
 * INTER-Mediator Ver.@@@@2@@@@ Released @@@@1@@@@
 *
 *   by Masayuki Nii  msyk@msyk.net Copyright (c) 2012 Masayuki Nii, All rights reserved.
 *
 *   This project started at the end of 2009.
 *   INTER-Mediator is supplied under MIT License.
 */
require_once('INTER-Mediator/INTER-Mediator.php');

IM_Entry(
    array(
        array(
            'name' => 'pagebuilder',
            'extending-class' => "PageFragments",
        ),
        array(
            'name' => 'newslist',
            'extending-class' => "PageFragments",
        ),
        array(
            "name" => "teachers2016",
            'aggregation-select' => "responsible.teacher_id, executed_year, teacher.name AS teacher_name, GROUP_CONCAT(subject.name) AS subjects, affiliation, title, photofile, focus, introduce",
            'aggregation-from' => "responsible INNER JOIN subject ON subject.subject_id = responsible.subject_id INNER JOIN teacher ON teacher.teacher_id = responsible.teacher_id",
            'aggregation-group-by' => "responsible.teacher_id",
            "query" => array(
                array("field" => "executed_year", "operator" => "=", "value" => "28"),
            ),
            "sort" => array(
                array("field" => "name_kana", "direction" => "asc"),
            ),
            "db-class" => "PDO",
        ),
        array(
            "name" => "subjectlist",
            "view" => "subject_syllabus",
            "table" => "dummy",
            "key" => "subject_id",
            "navi-control" => "master-hide",
            "records" => 100,
            "query" => array(
                array("field" => "executed_year", "operator" => "=", "value" => 28),
            ),
            "sort" => array(
                array("field" => "executed_year", "direction" => "desc"),
                array("field" => "semester", "direction" => "asc"),
                array("field" => "summary_wday", "direction" => "asc"),
            ),
            "button-names" => array(
                "navi-detail" => "シラバス 表示",
            ),
            "calculation" => array(
                array(
                    "field" => "semester_string",
                    "expression" => "if(semester=0,'前期',if(semester= 1.0,'1学期',if(semester=2.0,'2学期',
                        if(semester=2.5,'夏学期',if(semester=3.0,'3学期',
                        if(semester=4.0,'4学期',if(semester=5.0,'冬学期','')))))))"
                ),
                array(
                    "field" => "spec_Q1_string",
                    "expression" => "if(spec_Q1=1,'[基礎]',if(spec_Q1=2,'[応用]',spec_Q1_other))",
                ),
                array(
                    "field" => "spec_Q2_string",
                    "expression" => "if(spec_Q2=1,'[講義のみ]',if(spec_Q2=2,'[演習は50%未満]',if(spec_Q2=3,'[演習は50%超]',spec_Q1_other)))",
                ),
                array(
                    "field" => "spec_Q3_string",
                    "expression" => "if(spec_Q3=1,'[グループ作業は50%未満]',if(spec_Q3=2,'[グループ作業は50%超]',spec_Q1_other))",
                ),
                array(
                    "field" => "spec_Q41_string",
                    "expression" => "if(spec_Q41=1,'[事例のトピックがある]','')",
                ),
                array(
                    "field" => "spec_Q42_string",
                    "expression" => "if(spec_Q42=1,'[先端研究のトピックがある]','')",
                ),
                array(
                    "field" => "spec_Q43_string",
                    "expression" => "if(spec_Q43=1,'[網羅的である]','')",
                ),
                array(
                    "field" => "spec_Q4_string",
                    "expression" => "if(spec_Q4_other<>'','['+spec_Q4_other+']','')",
                ),
                array(
                    "field" => "remote_Q1_string",
                    "expression" => "if(remote_Q1>29,'[遠隔不可]',if(remote_Q1>19,'[一部は教室受講]',if(remote_Q1>9,'[遠隔可能]','')))",
                ),
                array(
                    "field" => "spec_Q2_Q3",
                    "expression" => "if(spec_Q2=1,1,if(spec_Q2=2,if(spec_Q3=1,2,3),if(spec_Q3=1,4,5)))",
                ),
                array(
                    "field" => "spec_Q41_on",
                    "expression" => "if(spec_Q4_1=1,'inline','none')",
                ),
                array(
                    "field" => "spec_Q42_on",
                    "expression" => "if(spec_Q4_2=1,'inline','none')",
                ),
                array(
                    "field" => "spec_Q43_on",
                    "expression" => "if(spec_Q4_3=1,'inline','none')",
                ),
                array(
                    "field" => "spec_Q44_on",
                    "expression" => "if(spec_Q4_4=1,'inline','none')",
                ),
                array(
                    "field" => "spec_Q45_on",
                    "expression" => "if(spec_Q4_5=1,'inline','none')",
                ),
                array(
                    "field" => "spec_Q46_on",
                    "expression" => "if(spec_Q4_6=1,'inline','none')",
                ),
            ),
        ),
        array(
            "name" => "subjectdetail",
            "view" => "subject",
            "table" => "dummy",
            "key" => "subject_id",
            "navi-control" => "detail",
            "records" => 1,
            "sort" => array(array("field" => "subject_id", "direction" => "asc")),
            "calculation" => array(
                array(
                    "field" => "semester_string",
                    "expression" => "if(semester=0,'前期',if(semester= 1.0,'1学期',if(semester=2.0,'2学期',
                        if(semester=2.5,'夏学期',if(semester=3.0,'3学期',
                        if(semester=4.0,'4学期',if(semester=5.0,'冬学期','')))))))"),
                array(
                    "field" => "Q1_string",
                    "expression" => "if(spec_Q1=1,'基礎',if(spec_Q1=2,'応用','その他'))"
                ),
                array(
                    "field" => "Q2_string",
                    "expression" => "if(spec_Q2=1,'講義のみ',if(spec_Q2=2,'演習は50%未満',if(spec_Q2=3,'演習は50%超','その他')))"
                ),
                array(
                    "field" => "Q3_string",
                    "expression" => "if(spec_Q3=1,'グループ作業は50%未満',if(spec_Q3=2,'グループ作業は50%超','その他'))"
                ),
                array(
                    "field" => "Q4_string",
                    "expression" => "if(spec_Q4=1,'事例のトピックがある',if(spec_Q4=2,'先端研究のトピックがある',if(spec_Q4=3,'網羅的である','その他')))"
                ),
                array("field" => "len_purpose", "expression" => "length(syllabus_purpose)"),
                array("field" => "style_purpose", "expression" => "if(length(syllabus_purpose)<70,'none','block')"),
                array("field" => "style_originality", "expression" => "if(length(syllabus_originality)<70,'none','block')"),
                array("field" => "style_difficulty", "expression" => "if(length(syllabus_difficulty)<70,'none','block')"),
                array("field" => "style_knowledge", "expression" => "if(length(syllabus_knowledge)<70,'none','block')"),
                array("field" => "style_prereq", "expression" => "if(length(syllabus_prereq)<70,'none','block')"),
                array("field" => "style_schedule", "expression" => "if(length(syllabus_schedule)<70,'none','block')"),
                array("field" => "style_detail", "expression" => "if(length(syllabus_detail)<70,'none','block')"),
                array("field" => "style_effect", "expression" => "if(length(syllabus_effect)<70,'none','block')"),
                array("field" => "style_tools", "expression" => "if(length(syllabus_tools)<70,'none','block')"),
                array("field" => "style_eval", "expression" => "if(length(syllabus_eval)<70,'none','block')"),
                array("field" => "style_ex", "expression" => "if(length(syllabus_ex)<70,'none','block')"),
                array("field" => "style_textbooks", "expression" => "if(length(syllabus_textbooks)<70,'none','block')"),
                array("field" => "style_originality2", "expression" => "if(length(syllabus_originality)<70 || label_id=1,'none','block')"),
            ),
        ),
    ),
    array(
        'formatter' => array(
            array(
                'field' => 'subject@syllabus_purpose',
                'converter-class' => 'MarkdownString',
                'parameter' => '',
            ),
            array(
                'field' => 'subject@syllabus_originality',
                'converter-class' => 'MarkdownString',
                'parameter' => '',
            ),
            array(
                'field' => 'subject@syllabus_difficulty',
                'converter-class' => 'MarkdownString',
                'parameter' => '',
            ),
            array(
                'field' => 'subject@syllabus_knowledge',
                'converter-class' => 'MarkdownString',
                'parameter' => 'autolink',
            ),
            array(
                'field' => 'subject@syllabus_prereq',
                'converter-class' => 'MarkdownString',
                'parameter' => 'autolink',
            ),
            array(
                'field' => 'subject@syllabus_schedule',
                'converter-class' => 'MarkdownString',
                'parameter' => 'autolink',
            ),
            array(
                'field' => 'subject@syllabus_detail',
                'converter-class' => 'MarkdownString',
                'parameter' => 'autolink',
            ),
            array(
                'field' => 'subject@syllabus_effect',
                'converter-class' => 'MarkdownString',
                'parameter' => 'autolink',
            ),
            array(
                'field' => 'subject@syllabus_tools',
                'converter-class' => 'MarkdownString',
                'parameter' => 'autolink',
            ),
            array(
                'field' => 'subject@syllabus_eval',
                'converter-class' => 'MarkdownString',
                'parameter' => 'autolink',
            ),
            array(
                'field' => 'subject@syllabus_ex',
                'converter-class' => 'MarkdownString',
                'parameter' => 'autolink',
            ),
            array(
                'field' => 'subject@syllabus_textbooks',
                'converter-class' => 'MarkdownString',
                'parameter' => 'autolink',
            ),
        ),
    ),
    array(
        'db-class' => 'Null',
    ),
    false
);

?>