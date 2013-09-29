ProcessManager
==============

Introduction
------------
ProcessManager is an module which helps run long time process 
as long as PHP limits allows it. The limits are memory and execution time.

### The areas of usage
* Ajax handlers. Where process was splitted by Ajax. 
* Garbage collectors. Where user initiate to clear cache, logs, etc.
* Core for crons. It is make crons more stable without time-limit or memory-limit errors.

### Example
The example file can be found here: `/Example.php`
