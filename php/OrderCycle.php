<?php
    class OrderCycle {
        // Actions
        private const ACTIONS = [
            'create',
            'start',
            'approve',
            'cancel',
            'degree'
        ];
        // Statuses
        private const STATUSES = [
            'new',
            'started',
            'done',
            'canceled',
            'failed'
        ];
        // ROLES
        private const ROLES = [
            'customer',
            'employee'
        ];

        private $task_id = 0;
        private $employee_id;
        private $customer_id;
        private $end_date;
        private $current_status;

        public function __construct($task_id, $employee_id, $customer_id, $end_date, $current_status) {
            $this->task_id = $task_id;
            $this->employee_id = $employee_id;
            $this->customer_id = $customer_id;
            $this->end_date = $end_date;
            $this->current_status = $current_status;
        }

        public function getStatuses() {
            return self::STATUSES;
        }

        public function getActions() {
            return self::ACTIONS;
        }

        public function getNextStatus($action) {
            switch ($action) {
                case self::ACTIONS[0]:
                    return $this->current_status = self::STATUSES[0];
                    break;
                case self::ACTIONS[1]:
                    return $this->current_status = self::STATUSES[1];
                    break;
                case self::ACTIONS[2]:
                    return $this->current_status = self::STATUSES[2];
                    break;
                case self::ACTIONS[3]:
                    return $this->current_status = self::STATUSES[3];
                    break;
                case self::ACTIONS[4]:
                    return $this->current_status = self::STATUSES[4];
                    break;
                default:
                     return $this->current_status = self::STATUSES[0];
            }
        }
    }
