<?php

namespace SardarBackend\RestfulApiHelper\RestfulApi;

/**
 * AppendsBuilder: A builder class for constructing ApiResponse objects.
 */
class AppendsBuilder
{
    /**
     * @var ApiResponse The ApiResponse object being constructed.
     */
    private ApiResponse $response;

    /**
     * Initializes a new instance of the AppendsBuilder class.
     */
    public function __construct()
    {
        $this->response = new ApiResponse();
    }

    /**
     * Sets the message for the response.
     *
     * @param string $message The message to set.
     * @return $this The current builder instance for method chaining.
     */
    public function withMessage(string $message): self
    {
        $this->response->setMessage($message);
        return $this;
    }

    /**
     * Sets the data payload for the response.
     *
     * @param mixed $data The data to set.
     * @return $this The current builder instance for method chaining.
     */
    public function withData(mixed $data): self
    {
        $this->response->setData($data);
        return $this;
    }

    /**
     * Sets the HTTP status code for the response.
     *
     * @param int $status The status code to set.
     * @return $this The current builder instance for method chaining.
     */
    public function withStatus(int $status): self
    {
        $this->response->setStatus($status);
        return $this;
    }

    /**
     * Sets additional key-value pairs to append to the response.
     *
     * @param array $appends An associative array of additional data.
     * @return $this The current builder instance for method chaining.
     */
    public function withAppends(array $appends): self
    {
        $this->response->setAppends($appends);
        return $this;
    }

    /**
     * Builds and returns the constructed ApiResponse object.
     *
     * @return ApiResponse The constructed ApiResponse object.
     */
    public function build(): ApiResponse
    {
        return $this->response;
    }
}
