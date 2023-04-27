<?php

class __Mustache_1f2b5c761d9cef1c853a4f93e6c12e41 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<div class="btn-group';
        $value = $context->find('manageurl');
        $buffer .= $this->section9fc76b4246a8311627091dab64d371ce($context, $indent, $value);
        $value = $context->find('courserequesturl');
        $buffer .= $this->sectionBd3acaef41e592bc6526d1fefc16177d($context, $indent, $value);
        $buffer .= '">
';
        $buffer .= $indent . '    <!-- Set as a link to appease Goutte behat. -->
';
        $buffer .= $indent . '    <a href="#" class="btn btn-link btn-icon icon-size-3 rounded-circle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="';
        $value = $context->find('str');
        $buffer .= $this->sectionCe65cc59832348d184573af1bbb90aa8($context, $indent, $value);
        $buffer .= '">
';
        $buffer .= $indent . '        <i class="fa fa-ellipsis-v text-dark  py-2" aria-hidden="true"></i>
';
        $buffer .= $indent . '    </a>
';
        $buffer .= $indent . '    <div class="dropdown-menu dropdown-menu-right">
';
        $value = $context->find('newcourseurl');
        $buffer .= $this->sectionFc4d7ff54e82800e6e1a2f9875a87472($context, $indent, $value);
        $value = $context->find('manageurl');
        $buffer .= $this->section318bae52d233314558641301dcd5ed7d($context, $indent, $value);
        $value = $context->find('courserequesturl');
        $buffer .= $this->section0f1fe2ad3d5d1576b1a7949e14520e2b($context, $indent, $value);
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</div>
';

        return $buffer;
    }

    private function section9fc76b4246a8311627091dab64d371ce(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' course-manage';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= ' course-manage';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionBd3acaef41e592bc6526d1fefc16177d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' course-request';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= ' course-request';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionCe65cc59832348d184573af1bbb90aa8(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'coursemanagementoptions, my';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'coursemanagementoptions, my';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section45fa045a20a700836bee54f962d54aae(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'newcourse, core';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'newcourse, core';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionFc4d7ff54e82800e6e1a2f9875a87472(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <a class="dropdown-item" href="{{newcourseurl}}">{{#str}}newcourse, core{{/str}}</a>
        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '            <a class="dropdown-item" href="';
                $value = $this->resolveValue($context->find('newcourseurl'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '">';
                $value = $context->find('str');
                $buffer .= $this->section45fa045a20a700836bee54f962d54aae($context, $indent, $value);
                $buffer .= '</a>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionAfcc826bc3fc756a6645e32600fb8b3d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'managecourses, core';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'managecourses, core';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section318bae52d233314558641301dcd5ed7d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <a class="dropdown-item" href="{{manageurl}}">{{#str}}managecourses, core{{/str}}</a>
        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '            <a class="dropdown-item" href="';
                $value = $this->resolveValue($context->find('manageurl'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '">';
                $value = $context->find('str');
                $buffer .= $this->sectionAfcc826bc3fc756a6645e32600fb8b3d($context, $indent, $value);
                $buffer .= '</a>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionAb9fee9cb73c743ad55f83bc01f69d80(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'requestcourse, core';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'requestcourse, core';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section0f1fe2ad3d5d1576b1a7949e14520e2b(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <a class="dropdown-item" href="{{courserequesturl}}">{{#str}}requestcourse, core{{/str}}</a>
        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '            <a class="dropdown-item" href="';
                $value = $this->resolveValue($context->find('courserequesturl'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '">';
                $value = $context->find('str');
                $buffer .= $this->sectionAb9fee9cb73c743ad55f83bc01f69d80($context, $indent, $value);
                $buffer .= '</a>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
