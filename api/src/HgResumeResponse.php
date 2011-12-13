<?php

define("API_VERSION", 1);

class HgResumeResponse {
	/* SUCCESS
	 * Operation completed successfully.
	 * In the context of a PushDataChunk, this indicates that the final chunk
	 *      was received successfully and the bundle was successfully applied.
	 * No further information is expected. */
	// HTTP 200 OK
	const SUCCESS = 0;

	/* RECEIVED
	 * Data was received and stored successfully.
	 * In the context of PushDataChunk, further *push* requests are expected. */
	// HTTP 202 Accepted
	const RECEIVED = 1;

	/* RESEND
	 * Data was received but did not validate with its checksum. */
	// HTTP 412 Precondition Failed
	const RESEND = 2;

	/* RESET
	 * Context: Push BundleChunk
	 * All data chunks received but the unbundle operation failed. Try resending the bundle.
	 *
	 * Context: Pull BundleChunk
	 * Repo changed in the middle of a pullBundleChunk session
	 * The server's bundle data is destroyed and the client is encouraged to restart pulling */
	// HTTP 400 Bad Request
	const RESET = 3;

	/* UNAUTHORIZED
	 * Invalid/missing username/password credentials were supplied. */
	// HTTP 401 Unauthorized
	const UNAUTHORIZED = 4;

	/* FAIL
	 * The operation failed because one more more parameters are invalid or
	 * were not understood.
	 * The request should NOT be repeated with the same parameter values. */
	// HTTP 400 Bad Request
	const FAIL = 5;

	/* UNKNOWNID
	 * The operation failed because the repoId is unknown among the
	 * repositories on the server. */
	// HTTP 400 Bad Request
	const UNKNOWNID = 6;

	/* NOCHANGE
	 * Request received but no operation was performed on the server
	 * In the context of PullDataChunk, this means that the baseHash provided
	 * resulted in no changesets to bundle for a Pull */
	// HTTP 304 Not Modified
	const NOCHANGE = 7;

	public $Code;
	public $Values;
	public $Content;
	public $Version;

	function __construct($code, $values = array(), $content = "", $version = API_VERSION) {
		$this->Code = $code;
		$this->Values = $values;
		$this->Content = $content;
		$this->Version = $version;
	}
}

?>