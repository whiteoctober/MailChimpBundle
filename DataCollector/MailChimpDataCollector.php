<?php

namespace Jirafe\Bundle\MailChimpBundle\DataCollector;

use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Jirafe\Bundle\MailChimpBundle\Connection\ConnectionInterface;

/**
 * MailChimpDataCollector
 *
 * @author Rich Sage <rich.sage@gmail.com>
 */
class MailChimpDataCollector extends DataCollector
{
    private $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * {@inheritdoc}
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data = array(
            'requests'  => $this->connection->getRequests(),
        );
    }

    /**
     * Gets a count of the requests made to MailChimp
     *
     * @return int|void
     */
    public function getRequestCount()
    {
        return count($this->data['requests']);
    }

    /**
     * Returns the requests
     *
     * @return
     */
    public function getRequests()
    {
        return $this->data['requests'];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'mail_chimp';
    }

}
