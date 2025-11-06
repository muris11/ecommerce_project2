<?php

namespace App\Traits;

trait WithAlert
{
    /**
     * Show success alert with consistent design
     *
     * @param string $message
     * @param array $options
     * @return void
     */
    public function alertSuccess($message, $options = [])
    {
        $defaultOptions = [
            'position' => 'top-end',
            'timer' => 3500,
            'toast' => true,
            'timerProgressBar' => true,
            'showConfirmButton' => false,
            'icon' => 'success',
            'iconColor' => '#10b981',
            'background' => '#f0fdf4',
            'color' => '#166534',
            'customClass' => [
                'popup' => 'border-l-4 border-green-500',
                'title' => 'text-sm font-semibold'
            ]
        ];

        $this->alert('success', $message, array_merge($defaultOptions, $options));
    }

    /**
     * Show error alert with consistent design
     *
     * @param string $message
     * @param array $options
     * @return void
     */
    public function alertError($message, $options = [])
    {
        $defaultOptions = [
            'position' => 'top-end',
            'timer' => 4000,
            'toast' => true,
            'timerProgressBar' => true,
            'showConfirmButton' => false,
            'icon' => 'error',
            'iconColor' => '#ef4444',
            'background' => '#fef2f2',
            'color' => '#991b1b',
            'customClass' => [
                'popup' => 'border-l-4 border-red-500',
                'title' => 'text-sm font-semibold'
            ]
        ];

        $this->alert('error', $message, array_merge($defaultOptions, $options));
    }

    /**
     * Show warning alert with consistent design
     *
     * @param string $message
     * @param array $options
     * @return void
     */
    public function alertWarning($message, $options = [])
    {
        $defaultOptions = [
            'position' => 'top-end',
            'timer' => 4000,
            'toast' => true,
            'timerProgressBar' => true,
            'showConfirmButton' => false,
            'icon' => 'warning',
            'iconColor' => '#f59e0b',
            'background' => '#fffbeb',
            'color' => '#92400e',
            'customClass' => [
                'popup' => 'border-l-4 border-yellow-500',
                'title' => 'text-sm font-semibold'
            ]
        ];

        $this->alert('warning', $message, array_merge($defaultOptions, $options));
    }

    /**
     * Show info alert with consistent design
     *
     * @param string $message
     * @param array $options
     * @return void
     */
    public function alertInfo($message, $options = [])
    {
        $defaultOptions = [
            'position' => 'top-end',
            'timer' => 3500,
            'toast' => true,
            'timerProgressBar' => true,
            'showConfirmButton' => false,
            'icon' => 'info',
            'iconColor' => '#3b82f6',
            'background' => '#eff6ff',
            'color' => '#1e40af',
            'customClass' => [
                'popup' => 'border-l-4 border-blue-500',
                'title' => 'text-sm font-semibold'
            ]
        ];

        $this->alert('info', $message, array_merge($defaultOptions, $options));
    }

    /**
     * Show confirmation dialog with consistent design
     *
     * @param string $title
     * @param string $text
     * @param string $confirmButtonText
     * @param string $cancelButtonText
     * @return void
     */
    public function alertConfirm($title, $text = '', $confirmButtonText = 'Ya, Lanjutkan', $cancelButtonText = 'Batal')
    {
        $this->alert('question', $title, [
            'text' => $text,
            'showCancelButton' => true,
            'confirmButtonText' => $confirmButtonText,
            'cancelButtonText' => $cancelButtonText,
            'confirmButtonColor' => '#667eea',
            'cancelButtonColor' => '#ef4444',
            'reverseButtons' => true,
            'focusCancel' => true,
            'customClass' => [
                'confirmButton' => 'px-6 py-2 rounded-lg font-semibold',
                'cancelButton' => 'px-6 py-2 rounded-lg font-semibold',
                'title' => 'text-lg font-bold text-gray-800',
                'htmlContainer' => 'text-gray-600'
            ]
        ]);
    }
}
