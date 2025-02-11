<?php
namespace SardarBackend\RestfulApiHelper\RestfulApi;

class ApiResponse
{
    /**
     * @var string|null Message to include in the response.
     */
    private ?string $message = null;

    /**
     * @var mixed Data payload for the response.
     */
    private mixed $data = null;

    /**
     * @var int HTTP status code for the response.
     */
    private int $status = 200;

    /**
     * @var array Additional key-value pairs to include in the response.
     */
    private array $appends = [];

    /**
     * Sets the message for the response.
     *
     * @param string $message The message to set.
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * Sets the data payload for the response.
     *
     * @param mixed $data The data to set.
     */
    public function setData(mixed $data): void
    {
        $this->data = $data;
    }

    /**
     * Sets the HTTP status code for the response.
     *
     * @param int $status The status code to set.
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * Sets additional key-value pairs to append to the response.
     *
     * @param array $appends An associative array of additional data.
     */
    public function setAppends(array $appends): void
    {
        $this->appends = $appends;
    }

    /**
     * Generates the JSON response.
     *
     * @return \Illuminate\Http\JsonResponse A JSON response containing the message, data, and additional appends.
     */
    public function response()
    {
        $body = [];

        // Add message to the response if it's not null
        !is_null($this->message) && $body['message'] = $this->message;

        // Add data to the response if it's not null
        !is_null($this->data) && $body['data'] = $this->data;

        // Merge additional appends with the response body
        $body = $body + $this->appends;

        // Return the response with the specified HTTP status
        return response()->json($body, $this->status);
    }
}
