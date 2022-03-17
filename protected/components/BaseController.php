<?php

class BaseController extends Controller
{
    private int $status = 0;
    private $error = null;
    private ?string $message = null;
    private int $status_code = 200;
    private $data;


    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function setError($error): void
    {
        $this->error = $error;
    }

    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    public function setStatusCode(int $status_code): void
    {
        $this->status_code = $status_code;
    }

    public function setData($data): void
    {
        $this->data = $data;
    }

    public function renderJSON(): void
    {
        $data = [
            'status' => $this->status,
            'error' => $this->error,
            'message' => $this->message,
            'status_code' => $this->status_code,
            'data' => $this->data,
        ];
        header('Content-type: application/json');
        if ($this->status === 0) {
            header('HTTP/1.1 400 Bad Request');
            $data['status_code'] = 400;
        }
        echo CJSON::encode($data);

        foreach (Yii::app()->log->routes as $route) {
            if ($route instanceof CWebLogRoute) {
                $route->enabled = false;
            }
        }
        Yii::app()->end();
    }
}