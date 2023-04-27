<?php

class __Mustache_2165d5ba19007d2db2ee215dc635ef53 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<div data-region="loading-placeholder-content" aria-hidden="true">
';
        $value = $context->find('cards');
        $buffer .= $this->section2b92aab24907bea4cf20beeecaa2fd00($context, $indent, $value);
        $value = $context->find('list');
        $buffer .= $this->sectionE902a55b1fa0c132890494c069398c91($context, $indent, $value);
        $value = $context->find('summary');
        $buffer .= $this->sectionE902a55b1fa0c132890494c069398c91($context, $indent, $value);
        $buffer .= $indent . '</div>
';

        return $buffer;
    }

    private function section2b92aab24907bea4cf20beeecaa2fd00(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <div class="card-deck dashboard-card-deck one-row" style="height: 13rem">
            {{> core_course/placeholder-course }}
            {{> core_course/placeholder-course }}
            {{> core_course/placeholder-course }}
            {{> core_course/placeholder-course }}
        </div>
    ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '        <div class="card-deck dashboard-card-deck one-row" style="height: 13rem">
';
                if ($partial = $this->mustache->loadPartial('core_course/placeholder-course')) {
                    $buffer .= $partial->renderInternal($context, $indent . '            ');
                }
                if ($partial = $this->mustache->loadPartial('core_course/placeholder-course')) {
                    $buffer .= $partial->renderInternal($context, $indent . '            ');
                }
                if ($partial = $this->mustache->loadPartial('core_course/placeholder-course')) {
                    $buffer .= $partial->renderInternal($context, $indent . '            ');
                }
                if ($partial = $this->mustache->loadPartial('core_course/placeholder-course')) {
                    $buffer .= $partial->renderInternal($context, $indent . '            ');
                }
                $buffer .= $indent . '        </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionE902a55b1fa0c132890494c069398c91(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <ul class="list-group">
            {{> block_myoverview/placeholder-course-list-item }}
            {{> block_myoverview/placeholder-course-list-item }}
            {{> block_myoverview/placeholder-course-list-item }}
            {{> block_myoverview/placeholder-course-list-item }}
        </ul>
    ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '        <ul class="list-group">
';
                if ($partial = $this->mustache->loadPartial('block_myoverview/placeholder-course-list-item')) {
                    $buffer .= $partial->renderInternal($context, $indent . '            ');
                }
                if ($partial = $this->mustache->loadPartial('block_myoverview/placeholder-course-list-item')) {
                    $buffer .= $partial->renderInternal($context, $indent . '            ');
                }
                if ($partial = $this->mustache->loadPartial('block_myoverview/placeholder-course-list-item')) {
                    $buffer .= $partial->renderInternal($context, $indent . '            ');
                }
                if ($partial = $this->mustache->loadPartial('block_myoverview/placeholder-course-list-item')) {
                    $buffer .= $partial->renderInternal($context, $indent . '            ');
                }
                $buffer .= $indent . '        </ul>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
